<?php

namespace App\Jobs;

use App\Constants\BaseConstants;
use App\Services\SmsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
class SendPolicyCode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $name;
    private $phone;
    private $code;
    private $type;
    private $logger;

    /**
     * SendPolicyCode constructor.
     * @param $name
     * @param $phone
     * @param $code
     * @param $type
     */
    public function __construct($name,$phone,$code,$type)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->code = $code;
        $this->type = $type;
        $this->logger = customerLoggerHandle("SendPolicy");
    }

    /**
     * @param SmsService $smsService
     * @return bool
     * @throws \Exception
     */
    public function handle(SmsService $smsService)
    {
        $note = "尊敬的 ".$this->name." 先生/女士，您在愚公点评购买了".BaseConstants::POLICY_TYPE_MAP[$this->type]."。激活码：[".$this->code."]。请妥善保管激活码并及时到愚公点评注册并激活";
        try {
//            $sms = app(SmsService::class);
            $smsService->sendMessage($note, $this->phone);
            $this->logger->debug("队列执行完成", [
                "name"     => $this->name,
                "phone"     => $this->phone,
                "code"     => $this->code,
            ]);
            return true;

        } catch (\Exception $exception) {
            throw $exception;
        }

    }
}
