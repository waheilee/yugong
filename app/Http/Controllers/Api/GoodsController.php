<?php

namespace App\Http\Controllers\Api;


use App\Constants\ErrorMsgConstants;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Controller;
use App\Models\GoodsModel;

class GoodsController extends Controller
{

    public function goodsList()
    {
        try{
            $data = GoodsModel::all();
            if ($data->isEmpty()){
                throw new ServiceException(ErrorMsgConstants::VALIDATION_DATA_ERROR,'没有商品');
            }
            return $this->wrapSuccessReturn(compact('data'));
        }catch (\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }
    }
}