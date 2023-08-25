<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProjectController;
use App\CustomErrors\Errors;

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
Route::get('/books/{book}', [BookController::class, 'show'])->missing(Errors::missing('Could not find book'));

Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{course}', [CourseController::class, 'show'])->missing(Errors::missing('Could not find course'));

Route::get('/chapters', [ChapterController::class, 'index']);
Route::get('/chapters/{chapter}', [ChapterController::class, 'show'])->missing(Errors::missing('Could not find chapter'));

Route::get('/lessons', [LessonController::class, 'index']);
Route::get('/lessons/{lesson}', [LessonController::class, 'show'])->missing(Errors::missing('Could not find lesson'));

Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{project}', [ProjectController::class, 'show'])->missing(Errors::missing('Could not find project'));

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user()->load('type');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/books', [BookController::class, 'store']);
    Route::put('/books/{book}', [BookController::class, 'update'])->missing(Errors::missing('Could not find book'));
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->missing(Errors::missing('Could not find book'));
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/courses', [CourseController::class, 'store']);
    Route::put('/courses/{course}', [CourseController::class, 'update'])->missing(Errors::missing('Could not find course'));
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->missing(Errors::missing('Could not find course'));
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/chapters', [ChapterController::class, 'store']);
    Route::put('/chapters/{chapter}', [ChapterController::class, 'update'])->missing(Errors::missing('Could not find chapter'));
    Route::delete('/chapters/{chapter}', [ChapterController::class, 'destroy'])->missing(Errors::missing('Could not find chapter'));
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/lessons', [LessonController::class, 'store']);
    Route::put('/lessons/{lesson}', [LessonController::class, 'update'])->missing(Errors::missing('Could not find lesson'));
    Route::delete('/lessons/{lesson}', [LessonController::class, 'destroy'])->missing(Errors::missing('Could not find lesson'));
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->missing(Errors::missing('Could not find project'));
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->missing(Errors::missing('Could not find project'));
});
