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


require __DIR__.'/auth.php';

Route::get('/{any?}', function (String $any = null) {
    $content = file_get_contents(__DIR__ . "/../public/root.html");
    return \Response::make($content, 200, [
        'Content-Type' => 'text/html',
    ]);
})->where('any', '.*');
