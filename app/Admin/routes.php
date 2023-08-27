<?php

use Illuminate\Routing\Router;
use App\Admin\Controllers\AdminUserController;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('books', AdminBookController::class);
    $router->resource('chapters', AdminChapterController::class);
    $router->resource('courses', AdminCourseController::class);
    $router->resource('course-categories', AdminCourseCategoryController::class);
    $router->resource('lessons', AdminLessonController::class);
    $router->resource('projects', AdminProjectController::class);
    $router->resource('users', AdminUserController::class);
    $router->resource('user-types', AdminUserTypeController::class);

});
