<?php

namespace App\Services\Api;


use App\Constants\BaseConstants;
use App\Constants\ErrorMsgConstants;
use App\Exceptions\ServiceException;
use App\Models\UserModel;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserService
{
    private $logger;

    public function __construct()
    {
        $this->logger = customerLoggerHandle("UserService");
    }
    /**
     * 手艺人登录
     * @param $phone
     * @param $password
     * @return array
     */
    public function login($phone, $password)
    {
        $user = ['phone'=>$phone, 'password'=>$password];
//dd($user);
//        $appUser = UserModel::wherePassword(Hash::make($password))->wherePhone($phone)->first();
        $isLogin = Auth::guard('user_api')->attempt($user);
        if ($isLogin) {
//            if ($appUser->status == BaseConstants::USER_STATUS_INIT) {
//                throw new ServiceException(ErrorMsgConstants::API_ERROR_MESSAGE, "账号未激活!");
//            }
//
//            if ($appUser->status == BaseConstants::USER_STATUS_LOCK) {
//                throw new ServiceException(ErrorMsgConstants::API_ERROR_MESSAGE, "账号已锁定!");
//            }

//            /** @var  VerificationCodeService $verificationCodeService */
//            $verificationCodeService = app(VerificationCodeService::class);
//            $verificationCodeService->checkVerificationCode($appUser->phone, $code);
            $appUser = UserModel::wherePhone($phone)->first();
            return [
                'token' => "Bearer " . $this->getToken($appUser)
            ];

        } else {
            throw new ServiceException(ErrorMsgConstants::API_ERROR_MESSAGE, "用户名或者密码错误!");
        }
    }

    /**
     * 手艺人注册
     * @param $password
     * @param $phone
     * @return array
     */
    public function register($password, $phone)
    {
        $goLoginPage = true;
        /**
         * 查询手机号是否存在
         */
        $checkAppUserPhone = $this->getAppUserInfoForPhone($phone);
        if ($checkAppUserPhone) {
            throw new ServiceException(ErrorMsgConstants::DEFAULT_ERROR, "该手机号[$phone]已被注册!");
        }
        try {

            DB::beginTransaction();
            /**
             * 用户主表
             */
            $appUser = $this->createAppUser($password, $phone);
            DB::commit();


        } catch (\Exception $exception) {
            $this->logger->debug("创建异常", getExceptionMainInfo($exception));
            DB::rollBack();
            if ($exception instanceof ServiceException) {
                throw $exception;
            }
            throw new ServiceException(ErrorMsgConstants::DEFAULT_ERROR, "创建用户失败!");
        }
        return ['name' => $phone, 'token' => "Bearer " . $this->getToken($appUser)];
    }

    /**
     * 创建用户
     * @param $password
     * @param $phone
     * @return UserModel
     */
    private function createAppUser($password, $phone)
    {
        $appUserModel = new UserModel();
        $appUserModel->name     = $phone;
        $appUserModel->password = Hash::make($password);
        $appUserModel->phone    = $phone;
        $appUserModel->status   = BaseConstants::USER_STATUS_INIT;
        $appUserModel->save();
        return $appUserModel;
    }

    /**
     * 获取token
     * @param UserModel $appUser
     */
    private function getToken(UserModel $appUser)
    {

        $this->logger->info("获得用户信息", [
//            $appUser->store,
            $appUser->phone,
        ]);

        if (!empty($appUser->remember_token)) {
            $this->outToken($appUser->remember_token);
        }

        $token = auth('user_api')->login($appUser);
        $appUser->remember_token = $token;
        $appUser->save();
        return $token;

    }
    private function outToken($remember_token)
    {
        try {
            if (!empty($remember_token)) {
//                auth('api')->
            }

            return true;
        } catch (\Exception $exception) {

            $this->logger->error("JWT刷新token异常", getExceptionMainInfo($exception));
            return false;
        }
    }

    private function getAppUserInfoForPhone($phone)
    {
        return UserModel::wherePhone($phone)->first();
    }

    public function userInfo()
    {
        $userModel = UserModel::whereId(getAppUserId())->first();
        if ($userModel){
            $data['name'] = $userModel->name;
            $data['phone'] = $userModel->phone;
            $data['avatar'] = $userModel->avatar;
            $data['level'] = $userModel->level;
            return $data;
        }else{
            throw new ServiceException(ErrorMsgConstants::DEFAULT_ERROR, "用户信息不存在!");
        }
    }
}