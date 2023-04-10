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

//Route::get('/index', 'App\Http\Controllers\YouTubeController@index')->name('index');
//Route::get('/', 'App\Http\Controllers\YouTubeController@index')->name('index');
//Route::get('/results', 'App\Http\Controllers\YouTubeController@results')->name('results');
//Route::get('/watch/{id}', 'App\Http\Controllers\YouTubeController@watch')->name('watch');
//Route::get('/', 'App\Http\Controllers\Auth\LoginController@redirectToGoogle');

// line webhook受取用
//Route::get('/line/webhook',    'App\Http\Controllers\LineApiController@postWebhook');
//Route::post('/line/webhook',    'App\Http\Controllers\LineApiController@callback')->name('line.callback');
//Route::post('/line/webhook', 'App\Http\Controllers\api\LineApiController@webhook')->name('line.webhook');
/*Route::group(['namespace' => 'Api'], function () {
    Route::post('/line/callback', 'LineBotController@callback')->name('line.callback');
});*/
// line メッセージ送信用
//Route::get('/line/message/send', 'App\Http\Controllers\LineApiController@sendMessage');

//Route::get('/login/google', 'App\Http\Controllers\Auth\LoginController@redirectToGoogle');
//Route::get('/login/google/callback', 'App\Http\Controllers\Auth\LoginController@handleGoogleCallback');
//Route::get('/login/google/callback', 'App\Http\Controllers\YouTubeController@index')->name('index');
//Route::get('/login/google/callback', 'App\Http\Controllers\Auth\LoginController@authGoogleCallback');
