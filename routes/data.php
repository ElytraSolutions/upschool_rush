<?php

namespace App\Routes\Data;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RichContentsController;
use App\CustomErrors\Errors;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;


Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{book}', [BookController::class, 'show'])->missing(Errors::missing());

Route::get('/courseCategories', [CourseCategoryController::class, 'index']);
Route::get('/courseCategories/{courseCategory}/courses', [CourseCategoryController::class, 'courses'])->missing(Errors::missing());

Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{course:slug}', [CourseController::class, 'show'])->missing(Errors::missing());
Route::get('/courses/{course:slug}/chapters', [CourseController::class, 'chapters'])->missing(Errors::missing());

Route::get('/chapters', [ChapterController::class, 'index']);
Route::get('/chapters/{chapter:slug}', [ChapterController::class, 'show'])->missing(Errors::missing());
Route::get('/chapters/{chapter:slug}/lessons', [ChapterController::class, 'show'])->missing(Errors::missing());

Route::get('/lessons', [LessonController::class, 'index']);
Route::get('/lessons/{lesson:slug}', [LessonController::class, 'show'])->missing(Errors::missing());

Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{project}', [ProjectController::class, 'show'])->missing(Errors::missing());

Route::get('/richContents', [RichContentsController::class, 'index']);
Route::get('/richContents/{richContent}', [RichContentsController::class, 'show'])->missing(Errors::missing());


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user()->load('type');
});

Route::middleware(['auth:sanctum'])->group(function ($route) {
    $route->post('/books', [BookController::class, 'store']);
    $route->put('/books/{book}', [BookController::class, 'update'])->missing(Errors::missing());
    $route->delete('/books/{book}', [BookController::class, 'destroy'])->missing(Errors::missing());
});

Route::middleware(['auth:sanctum'])->group(function ($route) {
    $route->post('/courses', [CourseController::class, 'store']);
    $route->put('/courses/{course}', [CourseController::class, 'update'])->missing(Errors::missing());
    $route->delete('/courses/{course}', [CourseController::class, 'destroy'])->missing(Errors::missing());
});

Route::middleware(['auth:sanctum'])->group(function ($route) {
    $route->post('/chapters', [ChapterController::class, 'store']);
    $route->put('/chapters/{chapter}', [ChapterController::class, 'update'])->missing(Errors::missing());
    $route->delete('/chapters/{chapter}', [ChapterController::class, 'destroy'])->missing(Errors::missing());
});

Route::middleware(['auth:sanctum'])->group(function ($route) {
    $route->post('/lessons', [LessonController::class, 'store']);
    $route->put('/lessons/{lesson}', [LessonController::class, 'update'])->missing(Errors::missing());
    $route->delete('/lessons/{lesson}', [LessonController::class, 'destroy'])->missing(Errors::missing());
});

Route::middleware(['auth:sanctum'])->group(function ($route) {
    $route->post('/projects', [ProjectController::class, 'store']);
    $route->put('/projects/{project}', [ProjectController::class, 'update'])->missing(Errors::missing());
    $route->delete('/projects/{project}', [ProjectController::class, 'destroy'])->missing(Errors::missing());
});
