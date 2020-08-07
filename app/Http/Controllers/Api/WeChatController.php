<?php

namespace App\Http\Controllers\Api;


use App\Constants\ErrorMsgConstants;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Controller;
use App\Models\GoodsOrderModel;
use Illuminate\Http\Request;
use Yansongda\Pay\Pay;

class WeChatController extends Controller
{

    /**
     * 微信支付
     * @param Request $request
     * @return array
     */
    public function weChatPay(Request $request)
    {
//        try{
            $id = $request->input('order_id');

            $orderModel = GoodsOrderModel::whereId($id)->first();
            if (!$orderModel){
                throw new ServiceException(ErrorMsgConstants::DEFAULT_ERROR,"无订单");
            }
//            dd($orderModel);
            $order = [
                'out_trade_no' => time(),
                'body' => $orderModel->title,
                'total_fee' => $orderModel->pay_money,
            ];
            $result = Pay::wechat(config('pay.wechat'))->mp($order);
            dd($result);
            $data =  $result->getTargetUrl();
            return $this->wrapSuccessReturn(compact('data'));
//        }catch (\Exception $exception){
//            return $this->wrapErrorReturn($exception);
//        }
        //return Pay::wechat(config('pay.wechat'))->wap($order)->send(); // laravel 框架中请直接 return $wechat->wap($order)
    }

    /**
     * 微信回调
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Yansongda\Pay\Exceptions\InvalidArgumentException
     */
    public function notify(Request $request)
    {
        try{
            $result = Pay::wechat(config('pay.wechat'))->verify();
            customerLoggerHandle("WeChatNotify")->debug('微信回调通知',$result->all());
//            Log::debug('wechat notify',$result->all());
        }catch (\Exception $exception){
            return Pay::wechat(config('pay.wechat'))->success();

        }
    }
}