<?php

namespace App\Http\Controllers\Api\User;


use App\Http\Controllers\Controller;
use App\Services\Api\UserService;
use App\Services\VerificationCodeService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * 用户登录接口
     * @param Request $request
     * @return array
     */
    public function login(Request $request)
    {
        try {
            $validatorRules = [
                'phone'       => 'required',
                'password'   => 'required',
            ];

            $validatorMessages = [
                'phone.required'       => "账户不能为空!",
                'password.required'   => "密码不能为空!",
            ];

            $this->requestValidator($request, $validatorRules, $validatorMessages);

            $name = $request->input('phone');
            $password = $request->input('password');
            $data = $this->userService->login($name, $password);
            return $this->wrapSuccessReturn(compact('data'));
        } catch (\Exception $exception) {
            return $this->wrapErrorReturn($exception);
        }
    }

    /**
     * 用户注册接口
     * @param Request $request
     * @return array
     */
    public function register(Request $request)
    {
        try {
            $validatorRules = [
                'phone'         => 'required',//手机号
                'password'      => 'required',  //登录密码
                'code'          => 'required',//验证码
            ];
            $validatorMessages = [
                'phone.required'         => "手机号不能为空!",
                'password.required'      => "密码不能为空!",
                'code.required'          => "验证码不能为空!",
            ];
            $this->requestValidator($request, $validatorRules, $validatorMessages);

            $password = $request->input('password');
            $phone = $request->input('phone');
            $code = $request->input('code');
            /**
             * 验证短信验证码
             * @var VerificationCodeService $verificationCodeService
             */
//            $verificationCodeService = app(VerificationCodeService::class);
//            $verificationCodeService->checkVerificationCode($phone, $code);

            $data = $this->userService->register($password, $phone);

            return $this->wrapSuccessReturn(compact('data'));
        } catch (\Exception $exception) {
            return $this->wrapErrorReturn($exception);
        }

    }


    /**
     * 安全登出接口
     * @return array
     */
    public function logout()
    {
        try {
            auth('user_api')->logout(true);
            $data = true;
            return $this->wrapSuccessReturn(compact('data'));
        } catch (\Exception $exception) {
            return $this->wrapErrorReturn($exception);
        }
    }
}