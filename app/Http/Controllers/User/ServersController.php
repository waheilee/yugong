<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use App\Models\ServerTempModel;
use App\Models\ServiceUserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yansongda\Pay\Pay;
class ServersController extends Controller
{

    public function serversList(Request $request)
    {
//        $request->input('address');
        try{
            $province = $request->input('province');
            $city     = $request->input('city');
            $county   = $request->input('county');
            $categoryId = $request->input('category_id');
            $serUserModel = DB::table('service_users')
                ->where(function ($query) use ($province) {
                    if (!empty($province)) {
                        $query->where('province','like','%'.$province.'%');
                    }
                })
                ->where(function ($query) use ($city) {
                    if (!empty($city)) {
                        $query->where('city','like','%'.$city.'%');
                    }
                })
                ->where(function ($query) use ($county) {
                    if (!empty($county)) {
                        $query->where('county','like','%'.$county.'%');
                    }
                })
                ->where(function ($query) use ($categoryId) {
                    if (!empty($categoryId)) {
                        $query->where('category_id',$categoryId);
                    }
                })
                ->crossJoin('servers_template','service_users.id','=','servers_template.ser_user_id')
                ->select('service_users.name','service_users.*','servers_template.name as goods_name','servers_template.id as goods_id','servers_template.price')
                ->get();
            $data = [];
            foreach ($serUserModel as $value){
//                dd($value->id);
                $item = [];
                $item['goods_id']      = $value->goods_id;
                $item['goods_name']    = $value->goods_name;
                $item['goods_price']   = $value->price;
                $item['server_avatar'] = $value->avatar;
                $item['server_name']   = $value->name;
                $item['server_start']  = 5;
                $item['work_age']      = '十年';
                $data[] = $item;
            }
            return $this->wrapSuccessReturn(compact('data'));
        }catch (\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }
    }


    public function serversDetail(Request $request)
    {
        try{
            $id = $request->input('goods_id');
            $serTplModel = ServerTempModel::whereId($id)->first();
            $serUserModel = ServiceUserModel::whereId($serTplModel->ser_user_id)->first();
            $data = [];
            $data['server_name'] = $serUserModel->name;
            $data['server_title'] = '金牌手艺人';
            $data['server_avatar'] = $serUserModel->avatar;
            $data['server_start']  = 5;
            $data['work_age']      = '十年';
            $data['history']      = 1883;
            $data['good_comment'] = '95%';
            $data['goods_id'] = $id;
            $data['goods_name'] = $serTplModel->name;
            $data['goods_title'] = $serTplModel->title;
            $data['goods_price'] = $serTplModel->price;
            $data['goods_content'] = $serTplModel->content;
            return $this->wrapSuccessReturn(compact('data'));
        }catch (\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }

//        dd($data);
    }

    public function createdOrder(Request $request)
    {
        try{
            $serTplId = $request->input('ser_id');
            $amount = $request->input('amount');//数量
            $name  = $request->input('name');
            $phone  = $request->input('phone');
            $address  = $request->input('address');
            $remake  = $request->input('remark');
            $serverTime = $request->input('time');//上门服务时间
            $serTplModel = ServerTempModel::whereId($serTplId)->first();
            $order = new OrderModel();
            $order->name = $name;
            $order->phone = $phone;
            $order->order_address = $address;
            $order->order_time = $serverTime;
            $order->area = $amount;
            $order->remark = $remake;
            $order->title = $serTplModel->name;
            $order->order_num       = date('YmdHis') . rand(100000, 999999);//订单流水号
            $order->user_id       = getAppUserId();
            $order->service_id       = $serTplModel->ser_user_id;
            $order->pay_money = exchangeToFen($amount*$serTplModel->price);
            $order->pay_time = date('Y-m-d h:i:s',time());
            $order->save();
            $data['order_id'] = $order->id;
            $data['order_price'] = exchangeToYuan($order->pay_money).'元';
            return $this->wrapSuccessReturn(compact('data'));
        }catch (\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }



//        $subject = null;
//
//        $aliPayOrder = [
//            'out_trade_no' => $order->order_num,
//            'total_amount' => exchangeToYuan($order->total_amount), // 支付金额
//            'subject'      =>  $subject, // 备注
//            'http_method'  => 'GET'
//        ];
//
//        $config = config('pay.wechat');
//
//        return  Pay::wechat($config)->wap($aliPayOrder);
    }

    public function weChatPay($id)
    {
//        $orderId = $request->input('order_id');
        $orderModel = OrderModel::whereId($id)->first();
        $order = [
            'out_trade_no' => time(),
            'body' => 'subject-测试',
            'total_fee' => $orderModel->pay_money,
        ];
        return Pay::wechat(config('pay.wechat'))->wap($order);
    }

}