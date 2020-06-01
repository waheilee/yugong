<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Services\Api\SerUserService;
use App\Services\VerificationCodeService;
use Illuminate\Http\Request;

class ServiceUserController extends Controller
{

    private $serUserService;

    public function __construct(SerUserService $serUserService)
    {
        $this->serUserService = $serUserService;
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
                'name.required'       => "账户不能为空!",
                'password.required'   => "密码不能为空!",
            ];

            $this->requestValidator($request, $validatorRules, $validatorMessages);

            $name = $request->input('phone');
            $password = $request->input('password');
            $data = $this->serUserService->login($name, $password);
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
                'password'      => 'required',  //登录密码
                'phone'         => 'required',//手机号
                'code'         => 'required',//手机号
            ];
            $validatorMessages = [
                'password.required'      => "密码不能为空!",
                'phone.required'         => "手机号不能为空!",
                'code.required'         => "验证码不能为空!",
            ];
            $this->requestValidator($request, $validatorRules, $validatorMessages);
            $password = $request->input('password');
            $phone = $request->input('phone');
            $code = $request->input('code');
            /**
             * 验证短信验证码
             * @var VerificationCodeService $verificationCodeService
             */
            $verificationCodeService = app(VerificationCodeService::class);
            $verificationCodeService->checkVerificationCode($phone, $code);

            $data = $this->serUserService->register($password, $phone);

            return $this->wrapSuccessReturn(compact('data'));
        } catch (\Exception $exception) {
            return $this->wrapErrorReturn($exception);
        }

    }

    /**
     * 验证码发送
     * @param Request $request
     * @return array
     */
    public function loginSendCode(Request $request)
    {
        try {

            $validatorRules = [
                'phone' => 'required', //用户名
            ];

            $validatorMessages = [
                'phone.required' => "手机号不能为空错误!",
            ];

            $this->requestValidator($request, $validatorRules, $validatorMessages);

            $phone = $request->input('phone');

            $data = $this->serUserService->loginSendCode($phone);

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
            auth('api')->logout(true);
            $data = true;
            return $this->wrapSuccessReturn(compact('data'));
        } catch (\Exception $exception) {
            return $this->wrapErrorReturn($exception);
        }
    }

    /**
     * 服务人员用户详情接口
     * @return array
     */
    public function userInfo()
    {
        try {

            $data = $this->serUserService->userInfo();
            return $this->wrapSuccessReturn(compact('data'));
        } catch (\Exception $exception) {
            return $this->wrapErrorReturn($exception);
        }
    }
}