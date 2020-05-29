<?php

use Illuminate\Http\Request;

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
//登录
    Route::post('login', 'Api\ServiceUserController@login');

//登录验证码
    Route::post('loginSendCode', 'Api\ServiceUserController@loginSendCode');

//注册
    Route::post('register', 'Api\ServiceUserController@register');




    /** jwt Auth Api  需要登录的接口*/
    Route::group(['middleware' => ['jwtAuth']], function () {
        //安全登出接口
        Route::post('logout', 'Api\ServiceUserController@logout');

        //用户详情接口
        Route::post('userInfo', 'Api\ActivePolicyController@userInfo');

        //邀请码查询保单信息
        Route::post('searchPolicyInfo','Api\ActivePolicyController@activeCode');

        //邀请码查询保单信息
        Route::post('confirmPolicy','Api\ActivePolicyController@activePolicy');

    });
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
