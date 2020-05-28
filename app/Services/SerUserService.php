<?php

namespace App\Services;


use App\Constants\BaseConstants;
use App\Constants\ErrorMsgConstants;
use App\Exceptions\ServiceException;
use App\Models\ServiceUserModel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SerUserService
{
    private $logger;

    public function __construct()
    {
        $this->logger = customerLoggerHandle("SerUserService");
    }
    /**
     * @param $name
     * @param $password
     * @return array
     */
    public function login($name, $password)
    {
        $appUser = ServiceUserModel::wherePassword(md5($password))->whereName($name)->first();
        if ($appUser) {
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

        /**
         * 查询用户名是否存在
         */

//        $checkAppUserName = $this->getAppUserInfoForName($name);
//        if ($checkAppUserName) {
//            throw new ServiceException(ErrorMsgConstants::DEFAULT_ERROR, "该用户名[$name]已被注册!");
//        }
        try {
//            $isLoginUserAndBuy = false;
//            if ($upPackages['fruitCoin'] > 0 || $upPackages['seedCoin'] > 0) {
//                $goLoginPage = false;
//                $isLoginUserAndBuy = true;
//
//                $fruitNumber = exchangeToFen($upPackages['fruitCoin']);
//                $appUserModel = getAppUserModel();
//                $balanceDecrementFruit = UserBalance::whereUserUuid($appUserModel->uuid)->where('fruit_coin', '>=', $fruitNumber)
//                    ->decrement('fruit_coin', $fruitNumber);
//
//                if ($balanceDecrementFruit == 0) {
//                    throw new ServiceException(ErrorMsgConstants::DEFAULT_ERROR, '扣减果实失败!余额不足!');
//                }
//
//
//                $seedNumber = exchangeToFen($upPackages['seedCoin']);
//
//                $balanceDecrementSeed = UserBalance::whereUserUuid($appUserModel->uuid)->where('fruit_coin', '>=', $seedNumber)
//                    ->decrement('seed_coin', $seedNumber);
//
//                if ($balanceDecrementSeed == 0) {
//                    throw new ServiceException(ErrorMsgConstants::DEFAULT_ERROR, '扣减种子失败!余额不足!');
//                }
//            }

            DB::beginTransaction();
            /**
             * 用户主表
             */
            $this->createAppUser($password, $phone);
//            $this->createAppUserBalance($appUserUuid, $upPackages);

//            if ($isLoginUserAndBuy) {
//                $this->registerDecrementCoinJob($userName, $fruitNumber, $appUserModel, $upPackages, $seedNumber);
//                $this->registerUserAddCoinJob($userName, $fruitNumber, $seedNumber, $appUserModel, $upPackages);
//                /** @var SaleManagementService $saleManagementService */
//                $saleManagementService = app(SaleManagementService::class);
//                $saleManagementService->saleReward($userName, $fruitNumber + $seedNumber, $appUserModel->name);
//            }

            DB::commit();


        } catch (\Exception $exception) {
            $this->logger->debug("创建异常", getExceptionMainInfo($exception));
            DB::rollBack();
            if ($exception instanceof ServiceException) {
                throw $exception;
            }
            throw new ServiceException(ErrorMsgConstants::DEFAULT_ERROR, "创建用户失败!");
        }
        return ['name' => $phone, 'loginPage' => $goLoginPage];
    }

    private function getToken(ServiceUserModel $appUser)
    {

        $this->logger->info("获得用户信息", [
//            $appUser->store,
            $appUser->phone,
        ]);

        if (!empty($appUser->remember_token)) {
            $this->outToken($appUser->remember_token);
        }

        $token = auth('api')->login($appUser);
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
        return ServiceUserModel::wherePhone($phone)->first();
    }

    /**
     * 创建账户

     * @param $password
     * @param $phone
     */
    private function createAppUser( $password, $phone)
    {
        $appUserModel = new ServiceUserModel();
        $appUserModel->name = $phone;
        $appUserModel->password = md5($password);
        $appUserModel->phone = $phone;
        $appUserModel->status = BaseConstants::USER_STATUS_INIT;

        $appUserModel->save();
    }

    /**
     * @param $phone
     * @return bool
     * @throws \Exception
     */
    public function loginSendCode($phone)
    {
        try {
            $cacheKey = "LOGIN_SEND_CODE_" . $phone;
            if (Cache::has($cacheKey)) {
                throw new ServiceException(ErrorMsgConstants::DEFAULT_ERROR, "短信发送过于频繁,请在2分钟以后重试!");
            }
//            $appUser = getAppUserModelForName($userName);
            /**
             * 发送短信验证码
             * @var VerificationCodeService $verificationCodeService
             */
            $verificationCodeService = app(VerificationCodeService::class);
            $vc = $verificationCodeService->sendVerificationCode($phone);

            Cache::put($cacheKey, $vc, 2);
            return $vc;
        } catch (\Exception $exception) {
            $this->logger->debug("异常", getExceptionMainInfo($exception));
            throw $exception;
        }
    }
}