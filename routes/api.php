<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/githubwebhook', function(Request $request) {
    $secret = env('GITHUB_WEBHOOK_SECRET');
    $hash = "sha1=" . hash_hmac('sha1', $request->getContent(), $secret);
    if ($request->ref != 'refs/heads/prod') {
        Log::error('Invalid ref');
        return 'Invalid ref';
    }
    $user = Process::run("whoami")->output();
    if (strcmp($hash, $request->header('X-Hub-Signature')) == 0) {
        $root_path = base_path();
        try {
            $gitResult = Process::path($root_path)->run('git pull');
            if(!$gitResult->successful()) {
                $output = $gitResult->output();
                $error = $gitResult->errorOutput();
                $exitCode = $gitResult->exitCode();
                Log::error("Response from stdout: " . $output);
                Log::error("Response from stderr: " . $error);
                Log::error("Response from status: " . $exitCode);
                return [
                    "message" => 'Pull failed',
                    "output" => $output,
                    "error" => $error,
                    "exitCode" => $exitCode,
                    "root" => $root_path,
                    "user" => $user,
                ];
            }
        } catch (Exception $e) {
            return "Exception on git pull";
        }
        try {
            $migrateResult = Process::path($root_path)->run('php artisan migrate');
            if(!$migrateResult->successful()) {
                $output = $migrateResult->output();
                $error = $migrateResult->errorOutput();
                $exitCode = $migrateResult->exitCode();
                Log::error("Response from stdout: " . $output);
                Log::error("Response from stderr: " . $error);
                Log::error("Response from status: " . $exitCode);
                return [
                    "message" => 'Migration failed',
                    "output" => $output,
                    "error" => $error,
                    "exitCode" => $exitCode,
                    "root" => $root_path,
                    "user" => $user,
                ];
            }
        } catch (Exception $e) {
            return "Exception on running migrations";
        }
        return 'Success';
    } else {
        Log::error('Invalid signature');
        return 'Invalid signature';
    }
});
