<?php

use App\Models\Lesson;
use App\Models\RichContent;
use Illuminate\Http\Request;
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

Route::group(['prefix' => 'auth'], function () {
    require __DIR__ . '/auth.php';
});

Route::group(['prefix' => 'data'], function () {
    require __DIR__ . '/data.php';
});

Route::get('/richContentView/{richContent}', function (RichContent $richContent) {
    return view('richContentView', ['content' => $richContent]);
});

Route::get('/filemanager/view', function (Request $request) {
    return view('filemanager');
});

Route::get('/{any?}', function (String $any = null) {
    return view('reactApp');
})->where('any', '.*');
