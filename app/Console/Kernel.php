<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\CertificateGenerated;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $rows = DB::table('course_completions')->where('email_sent', '=', 0)->whereDate('created_at', '<=', DB::raw('(NOW() - INTERVAL 2 DAY)'))->get();
            foreach ($rows as $row) {
                if ($row->certificate_path != null) {
                    $user = DB::table('users')->where('id', '=', $row->user_id)->first();
                    if (!$user) {
                        Log::error('User not found for course completion id ' . $row->id);
                        DB::table('course_completions')->where('id', '=', $row->id)->update(['email_sent' => 1]);
                        continue;
                    }
                    $course = DB::table('courses')->where('id', '=', $row->course_id)->first();
                    $msgOutput = Mail::to($user->email)->send(new CertificateGenerated($row->certificate_path, $user->first_name . " " . $user->last_name, $course->name));
                    if ($msgOutput) {
                        DB::table('course_completions')->where('id', '=', $row->id)->update(['email_sent' => 1]);
                        Log::info('Email sent to ' . $user->email . " for course " . $course->name);
                    }
                }
            }
        })->everyMinute()->appendOutputTo(storage_path('logs/laravel.log'));
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
