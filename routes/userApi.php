<?php
use \Illuminate\Support\Facades\Route;
/**
 * 消费端API
 */
Route::post('userRegister','User\UserController@register');
//登录
Route::post('userLogin', 'User\UserController@login');
//服务产品列表
Route::post('serversList', 'User\ServersController@serversList');
//服务产品详情
Route::post('serversDetail', 'User\ServersController@serversDetail');

//确认支付
Route::post('wechat/pay','User\WeChatController@weChatPay');
//微信回调接口
Route::post('wechat/pay/notify','User\WeChatController@notify');

Route::group(['middleware' => ['jwtUserAuth']],function(){
    //用户详情接口
    Route::post('info', 'User\UserController@userInfo');
    //安全登出接口
    Route::post('userLogout', 'User\UserController@logout');
    //订单详情接口
    Route::post('orderDetail','User\ServersController@orderDetail');
    //确认订单
    Route::post('confirmOrder','User\ServersController@createdOrder');

    Route::post('createOrder','User\ServersController@createdOrder');

    Route::post('wechatOauthCallback','User\ServersController@wechatOauthCallback');

});