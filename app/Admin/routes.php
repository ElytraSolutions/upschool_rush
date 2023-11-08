<?php

use App\Admin\Controllers\AdminBookController;
use App\Admin\Controllers\AdminChapterController;
use App\Admin\Controllers\AdminCourseCategoryController;
use App\Admin\Controllers\AdminCourseController;
use App\Admin\Controllers\AdminLessonController;
use App\Admin\Controllers\AdminLessonSectionContentsController;
use App\Admin\Controllers\AdminProjectController;
use App\Admin\Controllers\AdminUserController;
use App\Admin\Controllers\AdminUserTypeController;
use App\Admin\Controllers\RichContentController;
use App\CustomErrors\Errors;
use App\Admin\Controllers\AdminLessonSectionController;
use App\Http\Controllers\RichContentsController as APIRichContentsController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('htmlEditor', function () {
        return view('htmlEditor');
    });
    $router->get('/', 'HomeController@index')->name('home');
    $router->post('/richText', [RichContentController::class, 'store']);
    $router->resource('books', AdminBookController::class);
    $router->resource('book-categories',AdminBookCategoryController::class);
    $router->resource('chapters', AdminChapterController::class);
    $router->resource('courses', AdminCourseController::class);
    $router->resource('course-categories', AdminCourseCategoryController::class);
    $router->resource('lessons', AdminLessonController::class);
    $router->resource('lesson-sections', AdminLessonSectionController::class);
    $router->resource('lesson-section-contents', AdminLessonSectionContentsController::class);
    $router->resource('projects', AdminProjectController::class);
    $router->resource('users', AdminUserController::class);
    $router->resource('user-types', AdminUserTypeController::class);
    $router->resource('rich-content', RichContentController::class);

    $router->group(['prefix' => 'api'], function (Router $router) {
        $router->get('/chapters', [AdminChapterController::class, 'chapters']);
        $router->get('/courseCategories', [AdminCourseCategoryController::class, 'courseCategories']);
        $router->get('/courses', [AdminCourseController::class, 'courses']);

        $router->get('/chapters/byCourseId', [AdminChapterController::class, 'byCourseId']);
        $router->post('/chapters/byCourseId', [AdminChapterController::class, 'byCourseId']);

        $router->get('/lessons/byChapterId', [AdminLessonController::class, 'byChapterId']);
        $router->post('/lessons/byChapterId', [AdminLessonController::class, 'byChapterId']);
        $router->post('/lessons/byCourseId', [AdminLessonController::class, 'byCourseId']);

        $router->get('richContents', [APIRichContentsController::class, 'index']);
        $router->get('richContents/{richContent}', [APIRichContentsController::class, 'show']);
        $router->post('/richContents', [APIRichContentsController::class, 'store']);
        $router->put('/richContents/{richContent}', [APIRichContentsController::class, 'update'])->missing(Errors::missing());
        $router->delete('/richContents/{richContent}', [APIRichContentsController::class, 'destroy'])->missing(Errors::missing());
    });

    Route::get('/lessonEditor', function () {
        return view('htmlEditor');
    });
    Route::post('/tempLesson', [AdminLessonController::class, 'tempLesson']);
});
