<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::any('/wechat', 'User\WeChatController@serve');

Route::get('buy','User\WeChatController@buy')->name('buy'); //要访问的
Route::get('profit','User\WeChatController@profit')->name('profit'); //要跳转的
Route::get('share','User\ServersController@share')->name('share'); //要跳转的