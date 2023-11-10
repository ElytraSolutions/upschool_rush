<?php

namespace App\Routes\Data;

use App\Http\Controllers\BulkRegistrationController;
use App\Http\Controllers\CourseEnrollmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CourseCategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RichContentsController;
use App\CustomErrors\Errors;
use App\Http\Controllers\CharityController;
use App\Http\Controllers\TeacherStudentsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;


Route::get('/books', [BookController::class, 'index']);
//Route::get('/books/{book}', [BookController::class, 'show'])->missing(Errors::missing());
Route::post('/books/validate', [BookController::class, 'validateData']);
Route::post('/books/add-category', [BookController::class, 'addCategory']);



//testing start
//Note :: without validation of Book Page

Route::get('/books/list', [BookController::class, 'list']);
Route::get('/books/best-sellers', [BookController::class, 'bestSeller']);
Route::get('/books/featured', [BookController::class, 'featured']);
Route::get('/books/detail/{id}', [BookController::class, 'detail']);
//Route::post('/books/filter-by-category', [BookController::class, 'filterByCategory']);
//testing end

Route::get('/courseCategories', [CourseCategoryController::class, 'index']);
Route::get('/courseCategories/{courseCategory}/courses', [CourseCategoryController::class, 'courses'])->missing(Errors::missing());

Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{course:slug}', [CourseController::class, 'show'])->missing(Errors::missing());
Route::get('/courses/{course:slug}/chapters', [CourseController::class, 'chapters'])->missing(Errors::missing());
Route::get('/courses/{course:slug}/chapters/{chapter:slug}/lessons', [CourseController::class, 'lessons'])->missing(Errors::missing());

Route::get('/chapters', [ChapterController::class, 'index']);
Route::get('/chapters/{chapter:slug}', [ChapterController::class, 'show'])->missing(Errors::missing());
Route::get('/chapters/{chapter:slug}/lessons', [ChapterController::class, 'lessons'])->missing(Errors::missing());

Route::get('/lessons', [LessonController::class, 'index']);
Route::get('/lessons/{lesson:slug}', [LessonController::class, 'show'])->missing(Errors::missing());

Route::get('/charities', [CharityController::class, 'index']);
Route::get('/charities/{charity:slug}', [CharityController::class, 'show'])->missing(Errors::missing());

Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{project:slug}', [ProjectController::class, 'show'])->missing(Errors::missing());

Route::get('/richContents', [RichContentsController::class, 'index']);
Route::get('/richContents/{richContent}', [RichContentsController::class, 'show'])->missing(Errors::missing());


Route::get('/userTypes', function () {
    return [
        'success' => true,
        'data' => \App\Models\UserType::all(),
    ];
});

Route::middleware(['auth:sanctum'])->group(function ($route) {
    $route->get('/users/{user}', [UserController::class, 'show'])->missing(Errors::missing());
    $route->put('/users/{user}', [UserController::class, 'update'])->missing(Errors::missing());

    $route->get('/user', function (Request $request) {
        return $request->user()->load('type');
    });
    $route->get('/user/courses', [UserController::class, 'myCourses']);
});

Route::middleware(['auth:sanctum'])->group(function ($route) {
    $route->post('/books', [BookController::class, 'store']);
    $route->put('/books/{book}', [BookController::class, 'update'])->missing(Errors::missing());
    $route->delete('/books/{book}', [BookController::class, 'destroy'])->missing(Errors::missing());
    $route->post('/books/validate', [BookController::class, 'validateData'])->missing(Errors::missing());
});

Route::middleware(['auth:sanctum'])->group(function ($route) {
    $route->post('/courses', [CourseController::class, 'store']);
    $route->put('/courses/{course:slug}', [CourseController::class, 'update'])->missing(Errors::missing());
    $route->delete('/courses/{course:slug}', [CourseController::class, 'destroy'])->missing(Errors::missing());

    $route->get('/courses/{course:slug}/lessons', [CourseController::class, 'lessons'])->missing(Errors::missing());
    $route->get('/courses/{course:slug}/checkEnrollment', [CourseController::class, 'checkEnrollment'])->missing(Errors::missing());
    $route->get('/courses/{course:slug}/students', [CourseController::class, 'students'])->missing(Errors::missing());
    $route->post('/courses/{course:slug}/enroll', [CourseController::class, 'enroll'])->missing(Errors::missing());
    $route->delete('/courses/{course:slug}/enroll', [CourseController::class, 'unenroll'])->missing(Errors::missing());
});

Route::middleware(['auth:sanctum'])->group(function ($route) {
    $route->post('/chapters', [ChapterController::class, 'store']);
    $route->put('/chapters/{chapter:slug}', [ChapterController::class, 'update'])->missing(Errors::missing());
    $route->delete('/chapters/{chapter:slug}', [ChapterController::class, 'destroy'])->missing(Errors::missing());

    $route->post('/chapters/{chapter:slug}/lessons', [ChapterController::class, 'lessons'])->missing(Errors::missing());
});

Route::middleware(['auth:sanctum'])->group(function ($route) {
    $route->post('/lessons', [LessonController::class, 'store']);
    $route->put('/lessons/{lesson:slug}', [LessonController::class, 'update'])->missing(Errors::missing());
    $route->delete('/lessons/{lesson:slug}', [LessonController::class, 'destroy'])->missing(Errors::missing());

    $route->post('/lessons/{lesson:slug}/complete', [LessonController::class, 'complete'])->missing(Errors::missing());
    $route->get('/lessons/{lesson:slug}/checkCompletion', [LessonController::class, 'checkCompletion'])->missing(Errors::missing());
});

Route::middleware(['auth:sanctum'])->group(function ($route) {
    $route->post('/projects', [ProjectController::class, 'store']);
    $route->put('/projects/{project}', [ProjectController::class, 'update'])->missing(Errors::missing());
    $route->delete('/projects/{project}', [ProjectController::class, 'destroy'])->missing(Errors::missing());
});

Route::middleware(['auth:sanctum'])->group(function ($route) {
    $route->post('/enrollments', [CourseEnrollmentController::class, 'store']);
    $route->put('/enrollments/{enrollment}', [CourseEnrollmentController::class, 'update'])->missing(Errors::missing());
    $route->delete('/enrollments/{enrollment}', [CourseEnrollmentController::class, 'destroy'])->missing(Errors::missing());
});

Route::get('/images/{path}', function (Request $request) {
    $path = $request->query('path');
    if (Storage::disk('s3')->missing('file.jpg')) {
        return response()->json([
            'success' => false,
            'message' => 'File not found',
        ], 404);
    }
    $file = Storage::disk('s3')->get($path);
    $type = Storage::disk('s3')->mimeType($path);
    return response($file, 200)->header('Content-Type', $type);
});


Route::middleware(['auth:sanctum'])->group(function ($route) {
    $route->get('/teacher/students', [TeacherStudentsController::class, 'index']);
    $route->post('/teacher/addStudent', [TeacherStudentsController::class, 'store']);
    $route->post('/teacher/inviteStudent', [TeacherStudentsController::class, 'inviteStudent']);
});

Route::middleware(['auth:sanctum'])->group(function ($route) {
    $route->get('/bulkRegistrations/{bulkRegistration}', [BulkRegistrationController::class, 'show']);
    $route->post('/bulkRegistrations', [BulkRegistrationController::class, 'store']);
});
