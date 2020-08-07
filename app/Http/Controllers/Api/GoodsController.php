<?php

namespace App\Http\Controllers\Api;


use App\Constants\ErrorMsgConstants;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Controller;
use App\Models\GoodsModel;
use App\Models\GoodsOrderModel;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    /**
     * 商品列表
     * @return array
     */
    public function goodsList()
    {
        try{
            $data = GoodsModel::all(['id','name','title','price','thumb']);
            if ($data->isEmpty()){
                throw new ServiceException(ErrorMsgConstants::VALIDATION_DATA_ERROR,'没有商品');
            }
            return $this->wrapSuccessReturn(compact('data'));
        }catch (\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }
    }

    /**
     * 商品详情
     * @param Request $request
     * @return array
     */
    public function goodsDetail(Request $request)
    {
        $id = $request->input('id');
        try{
            $data = GoodsModel::whereId($id)->first(['id','thumb','name','title','price','original_price','sale_count','content']);
            if (empty($data)){
                throw new ServiceException(ErrorMsgConstants::VALIDATION_DATA_ERROR,'没有商品');
            }
            return $this->wrapSuccessReturn(compact('data'));
        }catch (\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }
    }

    /**
     * 商品订单
     * @param Request $request
     * @return array
     */
    public function createdGoodsOrder(Request $request)
    {
//        try{
            $amount     = $request->input('amount');//数量
            $id         = $request->input('id');
            $name       = $request->input('name');//联系人
            $phone      = $request->input('phone');//电话
            $address    = $request->input('address');//地址
            $goodsModel = GoodsModel::whereId($id)->first();
            if (empty($goodsModel)){
                throw new ServiceException(ErrorMsgConstants::VALIDATION_DATA_ERROR,'没有商品');
            }
            $goodsOrderModel = new GoodsOrderModel();
            $goodsOrderModel->user_id       = getAppUserUuid();
            $goodsOrderModel->title         = $goodsModel->name;
            $goodsOrderModel->pay_money     = exchangeToFen($goodsModel->price * $amount);
            $goodsOrderModel->order_num     = date('YmdHis') . rand(100000, 999999);//订单流水号;
            $goodsOrderModel->pay_time      = date('Y-m-d h:i:s',time());
            $goodsOrderModel->name          = $name;
            $goodsOrderModel->phone         = $phone;
            $goodsOrderModel->order_address = $address;
            $goodsOrderModel->save();
            $data = $goodsOrderModel;
            return $this->wrapSuccessReturn(compact('data'));
//        }catch (\Exception $exception){
//            return $this->wrapErrorReturn($exception);
//        }

    }
}