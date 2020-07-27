<?php
/**
 * Created by PhpStorm.
 * User: zrb
 * Date: 2018/7/19
 * Time: 下午7:53
 */

namespace App\Services;


use App\Constants\BaseConstants;
use App\Constants\ErrorMsgConstants;
use App\Exceptions\ServiceException;
use App\Models\SmsSend;
use Illuminate\Support\Facades\Cache;

class VerificationCodeService
{
    private $smsService;
    private $logger;

    public function __construct(SmsService $smsService)
    {
        $this->logger = customerLoggerHandle("VerificationCodeService");
        $this->smsService = $smsService;
    }


    /**
     * 发送验证码短信
     * @param $phone
     * @return bool
     * @throws ServiceException
     * @throws \Exception
     */
    public function sendVerificationCode($phone)
    {
        try {
            $this->checkPhoneNumberSend($phone);
            $smsSendModel = new SmsSend();
            $smsSendModel->uuid = generateNewUuid();
            $smsSendModel->phone = $phone;
            $smsSendModel->code = rand(1111, 9999);
            $smsSendModel->status = BaseConstants::SMS_SEND_STATUS_INIT;
            $smsSendModel->note = "验证码：" . $smsSendModel->code . "，验证码很重要，请勿泄露给他人。";
            $smsSendModel->lose_time = date('Y-m-d H:i:s', strtotime('+ 10 minutes'));
            $smsSendModel->type = BaseConstants::SMS_SEND_TYPE_VC;
            $smsSendModel->save();

            try {
                $this->smsService->sendMessage($smsSendModel->note, $smsSendModel->phone);
                $smsSendModel->status = BaseConstants::SMS_SEND_STATUS_DONE;
                $smsSendModel->save();

                return true;

            } catch (\Exception $exception) {
                $smsSendModel->status = BaseConstants::SMS_SEND_STATUS_ERROR;
                $smsSendModel->save();
                throw $exception;
            }
        } catch (\Exception $exception) {

            if ($exception instanceof ServiceException) {
                throw $exception;
            }

            throw new ServiceException(ErrorMsgConstants::DEFAULT_ERROR, "验证码发送失败!");
        }

    }

    /**
     * 验证验证码
     * @param $phone
     * @param $code
     * @return bool
     */
    public function checkVerificationCode($phone, $code)
    {

        if (empty($phone)){
            throw new ServiceException(ErrorMsgConstants::DEFAULT_ERROR,"手机号不能为空!");
        }
        $cacheKey = "CHECK_VERIFICATION_CODE" . $phone . date('H');
        if (Cache::has($cacheKey)) {
            if (Cache::get($cacheKey) >= 10) {
                throw new ServiceException(ErrorMsgConstants::DEFAULT_ERROR, "尝试次数过多");
            }
        }

        try {

            $smsSendModel = SmsSend::wherePhone($phone)
                ->whereIn('status', [
                    BaseConstants::SMS_SEND_STATUS_INIT,
                    BaseConstants::SMS_SEND_STATUS_DONE
                ])
                ->where('lose_time', '>=', date('Y-m-d H:i:s'))
                ->orderByDesc('created_at')->first();
            if (!$smsSendModel) {
                throw new ServiceException(ErrorMsgConstants::DEFAULT_ERROR, "验证码失效");
            }

            if ($code != $smsSendModel->code) {
                throw new ServiceException(ErrorMsgConstants::DEFAULT_ERROR, "验证码错误");
            }
            Cache::put($cacheKey, 0, 2);

            $smsSendModel->delete();
            return true;

        } catch (\Exception $exception) {
            Cache::increment($cacheKey, 1);
            $this->logger->debug("异常!", getExceptionMainInfo($exception));
            if ($exception instanceof ServiceException) {
                throw $exception;
            }

            throw new ServiceException(ErrorMsgConstants::DEFAULT_ERROR, "短信验证码验证失败!请稍后尝试!");
        }
    }

    /**
     * 检查发送验证码频率
     * @param $phone
     * @throws ServiceException
     */
    private function checkPhoneNumberSend($phone)
    {
        if (empty($phone)){
            throw new ServiceException(ErrorMsgConstants::DEFAULT_ERROR,"手机号不能为空!");
        }
        $smsSendModel = SmsSend::wherePhone($phone)
            ->whereIn('status', [
                BaseConstants::SMS_SEND_STATUS_INIT,
                BaseConstants::SMS_SEND_STATUS_DONE
            ])
            ->where('lose_time', '>=', date('Y-m-d H:i:s'))
            ->orderByDesc('created_at')->first();
        if ($smsSendModel) {
            throw new ServiceException(ErrorMsgConstants::DEFAULT_ERROR, "操作频繁!请稍后再尝试发送短信!");
        }
    }

    /**
     * @param $note
     * @param $phone
     * @return bool
     * @throws \Exception
     */
    public function sendPolicy($note,$phone)
    {
        try {
            $this->smsService->sendMessage($note, $phone);
            $this->logger->debug("队列执行完成", [
                "name"     => $note,
                "phone"     => $phone,
//                "code"     => $this->code,
//                "type"     => $this->type,
            ]);
            return true;

        } catch (\Exception $exception) {

            throw $exception;
        }
    }

}