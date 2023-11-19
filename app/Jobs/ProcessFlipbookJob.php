<?php

namespace App\Jobs;

use App\Models\FlipBookJobStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\MountManager;

class ProcessFlipbookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public FlipBookJobStatus $flipBookJobStatus)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $inputFilePath = $this->flipBookJobStatus->source_file;
            $outputFolder = $this->flipBookJobStatus->destination_folder;
            $this->flipBookJobStatus->status = FlipBookJobStatus::$STATUS_PROCESSING;
            $this->flipBookJobStatus->data = json_encode(['inputFilePath' => $inputFilePath, 'outputFolderPath' => $outputFolder]);
            $this->flipBookJobStatus->save();
            if (!Storage::disk('s3')->exists($inputFilePath)) {
                throw new \Exception('Input file not found');
            }
            $inputFile = Storage::disk('s3')->get($inputFilePath);
            Storage::disk('local')->put($inputFilePath, $inputFile);
            $inputFileLocalPath = Storage::disk('local')->path($inputFilePath);
            $outputFileLocalPath = Storage::disk('local')->path($outputFolder);
            if (!Storage::disk('local')->exists($outputFolder)) {
                Storage::disk('local')->makeDirectory($outputFolder);
            }
            $command = sprintf("gs -dNOPAUSE -dBATCH -sDEVICE=jpeg -r1000 -sOutputFile=%s/%%d.jpg %s", $outputFileLocalPath, $inputFileLocalPath);
            Log::info("Executing command: $command");
            $commandResult = [];
            exec($command, $commandResult);
            Log::info("Command result: " . json_encode($commandResult));
            $this->flipBookJobStatus->data = json_encode(['inputFilePath' => $inputFilePath, 'outputFolderPath' => $outputFolder, 'commandResult' => $commandResult]);
            foreach (Storage::disk('local')->files($outputFolder) as $file) {
                Storage::disk('s3')->writeStream($file, Storage::disk('local')->readStream($file));
            }
            $deleted = Storage::disk('local')->deleteDirectory($outputFolder);
            Log::info("Deleted local output folder: $deleted");
            $deleted = Storage::disk('local')->delete($inputFilePath);
            Log::info("Deleted local input file: $deleted");
            $deleted = Storage::disk('s3')->delete($inputFilePath);
            Log::info("Deleted s3 input file: $deleted");
            $this->flipBookJobStatus->status = FlipBookJobStatus::$STATUS_COMPLETED;
            $this->flipBookJobStatus->save();
        } catch (\Exception $e) {
            $this->flipBookJobStatus->status = FlipBookJobStatus::$STATUS_FAILED;
            $this->flipBookJobStatus->data = array_merge(json_decode($this->flipBookJobStatus->data, true), ['error' => $e->getMessage()]);
            $this->flipBookJobStatus->save();
        }
    }
}
