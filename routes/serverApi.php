<?php
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Route;
//保单填写
Route::post('createPolicy','Api\ActivePolicyController@createPolicy');


//登录
Route::post('login', 'Api\ServiceUserController@login');

//登录验证码
Route::post('loginSendCode', 'Api\ServiceUserController@loginSendCode');

//注册
Route::post('register', 'Api\ServiceUserController@register');

//获取分类
Route::post('getCategory','Api\CategoryController@treeView');

//获取课程列表
Route::post('getLessonList','Api\LessonController@lessonList');

//获取课程详情
Route::post('getLessonDetail','Api\LessonController@lessonDetail');

//首页
Route::post('homePage','Api\HomePageController@index');

//导航栏内容
Route::post('navDetail','Api\NavController@detail');
//验证身份证
Route::post('idValidator','Api\ServiceUserController@idValidator');



/** jwt Auth Api  需要登录的接口*/
Route::group(['middleware' => ['jwtAuth']], function () {
    //安全登出接口
    Route::post('logout', 'Api\ServiceUserController@logout');

    //用户详情接口
    Route::post('userInfo', 'Api\ServiceUserController@userInfo');

    //修改密码
    Route::post('changePass','Api\ServiceUserController@changePass');

    //头像设置
    Route::post('setAvatar','Api\ServiceUserController@setAvatar');



    //保单列表
    Route::post('policyList','Api\ActivePolicyController@policyList');

    //邀请码查询保单信息
    Route::post('searchPolicyInfo','Api\ActivePolicyController@activeCode');

    //邀请码查询保单信息
    Route::post('confirmPolicy','Api\ActivePolicyController@activePolicy');

    //获取试卷
    Route::post('getPaper','Api\ExamPaperController@paper');

    //提交试卷
    Route::post('examPaperOver','Api\ExamPaperController@total');

    //定制课程详情
    Route::post('planLessonDetail','Api\PlanLessonController@detail');

    //定制课程列表
    Route::post('planLessonList','Api\PlanLessonController@list');

    //考试记录列表
    Route::post('examRecordList','Api\ExamRecordController@list');

    //查看考试是否通过
    Route::post('examPass','Api\ExamPaperController@examPaperPass');

    //证书列表
    Route::post('cerList','Api\CertificateController@cerList');
    //换取证书
    Route::post('getCertificate','Api\CertificateController@getCertificate');
    //获取我的证书列表
    Route::post('getMyCertificateList','Api\CertificateController@myCertificateList');
    //获取地址列表
    Route::get('getAddressList','Api\SerAddressController@list');
    //添加地址
    Route::post('addAddress','Api\SerAddressController@store');
    //编辑地址
    Route::post('editAddress','Api\SerAddressController@edit');
    //更新地址
    Route::post('updateAddress','Api\SerAddressController@update');
    //删除地址
    Route::post('delAddress','Api\SerAddressController@delete');
    //设置默认地址
    Route::post('defaultAddress','Api\SerAddressController@default');

    //获取服务
    Route::get('serverList','Api\SerTplController@serverList');
    //换取服务
    Route::post('getServer','Api\SerTplController@getServer');
    //我的服务
    Route::post('myServer','Api\SerTplController@myServer');

    /**
     * 商城
     */
    //商品列表
    Route::get('getGoodsList','Api\GoodsController@goodsList');
    //
    Route::post('getGoodsDetail','Api\GoodsController@goodsDetail');
    //订单
    Route::post('createGoodsOrder','Api\GoodsController@createdGoodsOrder');

});