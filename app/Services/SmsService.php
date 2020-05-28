<?php
/**
 * Created by PhpStorm.
 * User: zrb
 * Date: 2018/7/19
 * Time: 下午7:53
 */

namespace App\Services;


use App\Constants\ErrorMsgConstants;
use App\Exceptions\ServiceException;

class SmsService
{
    public $smsTag = "【愚公点评】";
    private $logger;
    private $apiLinkService;

    public function __construct(ApiLinkService $apiLinkService)
    {
        $this->logger = customerLoggerHandle("SmsService");
        $this->apiLinkService = $apiLinkService;
    }

    /**
     * 发送验证码
     * @param $messages
     * @param $toPhone
     * @throws ServiceException
     */
    public function sendMessage($messages, $toPhone)
    {
        /**
         *    http://47.95.33.177:9002/df_httpserver/smsSend.do?username=100001&pwd=E10LFDGLKF20F883E0F8830F883&mobile=18212341234&content=putongduanxin
         */
        if (empty($messages) || empty($toPhone)) {
            throw new ServiceException(ErrorMsgConstants::DEFAULT_ERROR, "信息或者手机号不能为空");
        }
        //验证码：1234，验证码很重要，请勿泄露给他人。
        $smsMessage = $this->smsTag . $messages;

        $this->smsClient($smsMessage, $toPhone);
    }

    /**
     * @param $smsMessage
     * @param $toPhone
     * @return mixed
     * @throws ServiceException
     */
    private function smsClient($smsMessage, $toPhone)
    {

        $host = env('SMS_HOST');//"http://47.95.33.177:9002/";
        $method = "df_httpserver/smsSend.do";
        $requestData = [
            'username' => env('SMS_USER_ID'),
            'pwd'      => strtoupper(md5(env('SMS_USER_PWD'))),
            'mobile'   => $toPhone,
            'content'  => $smsMessage
        ];
        $this->logger->debug("sms request data", $requestData);


        $resData = $this->apiLinkService->getClient($host, $method, $requestData);

        $this->logger->debug("sms res data", [$resData]);

        /**
         * {"Status":"ok","MsgInfo":"1000000","Code":"0","CodeInfo":"结果正常"}
         */
        if ($resData['Status'] != "ok") {
            throw new ServiceException(ErrorMsgConstants::DEFAULT_ERROR, "短信发送失败");
        }

        return $resData;
    }

}