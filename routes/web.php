<?php

use App\Models\Lesson;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'auth'], function() {
    require __DIR__.'/auth.php';
});

Route::group(['prefix' => 'data'], function() {
    require __DIR__.'/data.php';
});

Route::get('/{any?}', function (String $any = null) {
    return view('reactApp');
})->where('any', '.*');
