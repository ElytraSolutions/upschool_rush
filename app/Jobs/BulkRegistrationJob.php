<?php

namespace App\Jobs;

use App\Mail\SendStudentLogin;
use App\Models\BulkRegistration;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BulkRegistrationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $csv_path;
    /**
     * Create a new job instance.
     */
    public function __construct(public BulkRegistration $bulkRegistration)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->bulkRegistration->status = BulkRegistration::$STATUS_PROCESSING;
        $this->bulkRegistration->save();
        try {
            $contents = Storage::disk('s3')->get($this->bulkRegistration->csv_path);
            $csv = new \ParseCsv\Csv();
            $csv->parse($contents, 1);
            // $this->bulkRegistration->data = json_encode(['data' => $csv->data, 'content' => $contents]);
            $this->bulkRegistration->data = json_encode(['data' => $csv->data]);
            $this->bulkRegistration->status = BulkRegistration::$STATUS_COMPLETED;
            $data = $csv->data;
            $data = array_map(function ($item) {
                return array_merge($item, [
                    'id' => (string) Str::orderedUuid(),
                    'password' => bcrypt('password'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }, $data);
            for ($i = 0; $i < count($data); $i++) {
                $password = 'password';
                Mail::to($data[$i]['email'])->send(new SendStudentLogin($data[$i]['email'], $password));
            }
            User::insert($data);
            $this->bulkRegistration->save();
        } catch (\Exception $e) {
            $this->bulkRegistration->status = BulkRegistration::$STATUS_COMPLETED;
            $this->bulkRegistration->data = json_encode(['error' => $e->getMessage()]);
            $this->bulkRegistration->save();
        }
    }
}
