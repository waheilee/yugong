<?php

namespace App\Jobs;

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
    private $logger;

    /**
     * SendPolicyCode constructor.
     * @param $name
     * @param $phone
     * @param $code
     */
    public function __construct($name,$phone,$code)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->code = $code;
        $this->logger = customerLoggerHandle("SendPolicyCode");
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $this->logger->debug("队列执行完成", [
            "name"     => $this->name,
            "phone"     => $this->phone,
            "code"     => $this->code,
        ]);
    }
}
