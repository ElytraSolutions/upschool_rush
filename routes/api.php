<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProjectController;
use App\CustomErrors\Errors;
use Illuminate\Support\Facades\Log;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{book}', [BookController::class, 'show'])->missing(Errors::missing());

Route::get('/courseCategories', [CourseCategoryController::class, 'index']);
Route::get('/courseCategories/{courseCategory}/courses', [CourseCategoryController::class, 'courses'])->missing(Errors::missing());

Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{course}', [CourseController::class, 'show'])->missing(Errors::missing());

Route::get('/chapters', [ChapterController::class, 'index']);
Route::get('/chapters/{chapter}', [ChapterController::class, 'show'])->missing(Errors::missing());

Route::get('/lessons', [LessonController::class, 'index']);
Route::get('/lessons/{lesson}', [LessonController::class, 'show'])->missing(Errors::missing());

Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{project}', [ProjectController::class, 'show'])->missing(Errors::missing());

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user()->load('type');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/books', [BookController::class, 'store']);
    Route::put('/books/{book}', [BookController::class, 'update'])->missing(Errors::missing());
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->missing(Errors::missing());
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/courses', [CourseController::class, 'store']);
    Route::put('/courses/{course}', [CourseController::class, 'update'])->missing(Errors::missing());
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->missing(Errors::missing());
    Route::get('/courses/{course}/chapters', [CourseController::class, 'chapters'])->missing(Errors::missing());
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/chapters', [ChapterController::class, 'store']);
    Route::put('/chapters/{chapter}', [ChapterController::class, 'update'])->missing(Errors::missing());
    Route::delete('/chapters/{chapter}', [ChapterController::class, 'destroy'])->missing(Errors::missing());
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/lessons', [LessonController::class, 'store']);
    Route::put('/lessons/{lesson}', [LessonController::class, 'update'])->missing(Errors::missing());
    Route::delete('/lessons/{lesson}', [LessonController::class, 'destroy'])->missing(Errors::missing());
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->missing(Errors::missing());
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->missing(Errors::missing());
});

Route::post('/githubwebhook', function(Request $request) {
    $secret = env('GITHUB_WEBHOOK_SECRET');
    $hash = "sha1=" . hash_hmac('sha1', $request->getContent(), $secret);
    if ($request->ref != 'refs/heads/prod') {
        Log::error('Invalid ref');
        return 'Invalid ref';
    }
    if (strcmp($hash, $request->header('X-Hub-Signature')) == 0) {
        $root_path = base_path();
        $process = new \Symfony\Component\Process\Process(['git', 'pull'], $root_path);
        $process->run();
        if(!$process->isSuccessful()) {
            Log::info("Response from stdout: " . $process->getOutput());
            Log::info("Response from stderr: " . $process->getErrorOutput());
            Log::info("Response from status: " . $process->getExitCode());
        }
        return 'Success';
    } else {
        Log::error('Invalid signature');
        return 'Invalid signature';
    }
});
