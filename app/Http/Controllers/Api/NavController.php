<?php

namespace App\Http\Controllers\Api;


use App\Constants\ErrorMsgConstants;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Controller;
use App\Models\NavModel;
use Illuminate\Http\Request;

class NavController extends Controller
{

    public function detail(Request $request)
    {
        try{
            $id = $request->input('nav_id');
            $data = NavModel::whereId($id)->first();
            if (!$data){
                throw new ServiceException(ErrorMsgConstants::DEFAULT_ERROR, "没有查找内容");
            }
            return $this->wrapSuccessReturn(compact('data'));
        }catch (\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }

    }
}