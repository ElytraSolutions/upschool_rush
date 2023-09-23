<?php

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
    if (strcmp($hash, $request->header('X-Hub-Signature')) == 0) {
        $root_path = base_path();
        $process = new Process(['whoami'], $root_path);
        $process->run();
        if(true) {
            Log::error("Response from stdout: " . $process->getOutput());
            Log::error("Response from stderr: " . $process->getErrorOutput());
            Log::error("Response from status: " . $process->getExitCode());
        }
        $process = new Process(['git', 'pull'], $root_path);
        $process->run();
        if(!$process->isSuccessful()) {
            Log::error("Response from stdout: " . $process->getOutput());
            Log::error("Response from stderr: " . $process->getErrorOutput());
            Log::error("Response from status: " . $process->getExitCode());
            return 'Pull failed';
        }
        $process = new Process(['sail', 'artisan', 'migrate'], $root_path);
        $process->run();
        if(!$process->isSuccessful()) {
            Log::error("Response from stdout: " . $process->getOutput());
            Log::error("Response from stderr: " . $process->getErrorOutput());
            Log::error("Response from status: " . $process->getExitCode());
            return 'Migrate failed';
        }
        return 'Success';
    } else {
        Log::error('Invalid signature');
        return 'Invalid signature';
    }
});
