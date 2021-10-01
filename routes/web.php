<?php

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
/*Route::get('/', function () {
    return 'welcome';
});*/

Route::get('/', 'App\Http\Controllers\YouTubeController@index')->name('index');
//Route::get('/', 'App\Http\Controllers\YouTubeController@index')->name('index');
Route::get('/results', 'App\Http\Controllers\YouTubeController@results')->name('results');
Route::get('/watch/{id}', 'App\Http\Controllers\YouTubeController@watch')->name('watch');
//Route::get('/login', 'App\Http\Controllers\Auth\LoginController@redirectToGoogle');

//Route::post('/line/callback',    'App\Http\Controllers\LineApiController@postWebhook');
// line webhook受取用
Route::get('/line/webhook',    'App\Http\Controllers\LineApiController@postWebhook');
// line メッセージ送信用
Route::get('/line/message/send', 'App\Http\Controllers\LineApiController@sendMessage');

//Route::get('/login/google', 'App\Http\Controllers\Auth\LoginController@redirectToGoogle');
//Route::get('/login/google/callback', 'App\Http\Controllers\Auth\LoginController@handleGoogleCallback');
//Route::get('/login/google/callback', 'App\Http\Controllers\YouTubeController@index')->name('index');
Route::get('/login/google/callback', 'App\Http\Controllers\Auth\LoginController@authGoogleCallback');