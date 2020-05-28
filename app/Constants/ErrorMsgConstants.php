<?php
/**
 * Created by PhpStorm.
 * User: wangwentong
 * Date: 2018/7/19
 * Time: 下午7:14
 */

namespace App\Constants;


class ErrorMsgConstants
{
    //公共错误码
    const RETURN_SUCCESS = 10000;//操作成功
    const SIGN_ERROR = 12000;//签名错误
    const VALIDATION_DATA_ERROR = 13000;//参数错误
    const API_ERROR_MESSAGE = 14000;//接口异常
    const DEFAULT_ERROR = 15000;
    const TOKEN_ERROR = 16000;
    const RAISE_OVER = 88888;

    public static $errorMsg = [
        //公共
        self::RETURN_SUCCESS        => '操作成功',
        self::SIGN_ERROR            => '签名错误',
        self::VALIDATION_DATA_ERROR => '参数错误',
        self::API_ERROR_MESSAGE     => '接口异常',
        self::DEFAULT_ERROR         => '系统异常',
        self::TOKEN_ERROR           => "令牌失效!请重新登录!"
    ];

    // 解析返回值失败
    const PARSING_FAILED = 10005;
}