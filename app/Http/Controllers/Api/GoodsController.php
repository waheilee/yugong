<?php

namespace App\Http\Controllers\Api;


use App\Constants\ErrorMsgConstants;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Controller;
use App\Models\GoodsModel;
use Illuminate\Http\Request;

class GoodsController extends Controller
{

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

    public function goodsDetail(Request $request)
    {
        $id = $request->input('id');
        try{
            $data = GoodsModel::whereId($id)->first(['thumb','name','title','price','original_price','sale_count','content']);
            if (empty($data)){
                throw new ServiceException(ErrorMsgConstants::VALIDATION_DATA_ERROR,'没有商品');
            }
            return $this->wrapSuccessReturn(compact('data'));
        }catch (\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }
    }
}