<?php

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('cors')->group(function () {

    //服务端api
    require base_path('routes/serverApi.php');
    //消费端api
    require base_path('routes/userApi.php');

});

Route::get('profit','User\WeChatController@profit')->name('profit'); //要跳转的
Route::get('buy','User\WeChatController@buy')->name('buy'); //要跳转的


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
