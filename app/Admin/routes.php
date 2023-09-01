<?php

use App\Admin\Controllers\AdminCourseController;
use App\Admin\Controllers\RichContentController;
use App\Http\Controllers\RichContentsController as APIRichContentsController;
use App\CustomErrors\Errors;
use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('htmlEditor', function(Request $request) {
        return view('htmlEditor');
    });
    $router->get('/', 'HomeController@index')->name('home');
    $router->post('/richText', [RichContentController::class, 'store']);
    $router->resource('books', AdminBookController::class);
    $router->resource('chapters', AdminChapterController::class);
    $router->resource('courses', AdminCourseController::class);
    $router->resource('course-categories', AdminCourseCategoryController::class);
    $router->resource('lessons', AdminLessonController::class);
    $router->resource('projects', AdminProjectController::class);
    $router->resource('users', AdminUserController::class);
    $router->resource('user-types', AdminUserTypeController::class);
    $router->resource('rich-content', RichContentController::class);

    $router->group(['prefix' => 'api'], function (Router $router) {
        $router->get('/chapters', [AdminChapterController::class, 'chapters']);
        $router->get('/courseCategories', [AdminCourseCategoryController::class, 'courseCategories']);
        $router->get('/courses', [AdminCourseController::class, 'courses']);

        $router->get('richContents', [APIRichContentsController::class, 'index']);
        $router->get('richContents/{richContent}', [APIRichContentsController::class, 'show']);
        $router->post('/richContents', [APIRichContentsController::class, 'store']);
        $router->put('/richContents/{richContent}', [APIRichContentsController::class, 'update'])->missing(Errors::missing());
        $router->delete('/richContents/{richContent}', [APIRichContentsController::class, 'destroy'])->missing(Errors::missing());
    });

    Route::get('/lessonEditor', function (Request $request) {
        return view('htmlEditor');
    });
    Route::post('/tempLesson', [AdminLessonController::class, 'tempLesson']);

});
