<?php

namespace App\Http\Controllers\Api;


use App\Constants\ErrorMsgConstants;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Controller;
use App\Models\SerAddressModel;
use Illuminate\Http\Request;

class SerAddressController extends Controller
{

    public function list()
    {
        try{
            $serId = getAppUserModel()->id;
            $data  = SerAddressModel::whereSerId($serId)->get();
            return $this->wrapSuccessReturn(compact('data'));
        }catch (\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }
    }

    public function store(Request $request)
    {
        $name     = $request->input('name');
        $phone    = $request->input('phone');
        $province = $request->input('province');
        $city     = $request->input('city');
        $county   = $request->input('county');
        $address  = $request->input('address');
        $serAddressModel = new SerAddressModel();
        $serAddressModel->name     = $name;
        $serAddressModel->ser_id   = getAppUserModel()->id;
        $serAddressModel->phone    = $phone;
        $serAddressModel->province = $province;
        $serAddressModel->city     = $city;
        $serAddressModel->county   = $county;
        $serAddressModel->address  = $address;
        $data = $serAddressModel->save();
        return $this->wrapSuccessReturn(compact('data'));
    }

    public function edit(Request $request)
    {
        $id = $request->input('address_id');
        try{
            $data = SerAddressModel::whereId($id)->first();
            if (!$data){
                throw new ServiceException(ErrorMsgConstants::VALIDATION_DATA_ERROR,'未找到地址');
            }
            return $this->wrapSuccessReturn(compact('data'));
        }catch (\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }
    }

    public function update(Request $request)
    {
        $id       = $request->input('address_id');
        $name     = $request->input('name');
        $phone    = $request->input('phone');
        $province = $request->input('province');
        $city     = $request->input('city');
        $county   = $request->input('county');
        $address  = $request->input('address');
        $serAddressModel = SerAddressModel::whereId($id)->first();
        $serAddressModel->name     = $name;
        $serAddressModel->ser_id   = getAppUserModel()->id;
        $serAddressModel->phone    = $phone;
        $serAddressModel->province = $province;
        $serAddressModel->city     = $city;
        $serAddressModel->county   = $county;
        $serAddressModel->address  = $address;
        $data = $serAddressModel->update();
        return $this->wrapSuccessReturn(compact('data'));
    }

    public function delete(Request $request)
    {
        $id = $request->input('address_id');
        try{
            $serAddressModel = SerAddressModel::whereId($id)->first();
            if (!$serAddressModel){
                throw new ServiceException(ErrorMsgConstants::VALIDATION_DATA_ERROR,'地址不存在');
            }
            $data = $serAddressModel->delete();
            return $this->wrapSuccessReturn(compact('data'));
        }catch (\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }
    }

    public function default(Request $request)
    {
        try{
            $addressId = $request->input('address_id');
            $serId = getAppUserModel()->id;
            SerAddressModel::whereSerId($serId)->update(['default'=>0]);
            $serAddress = SerAddressModel::whereId($addressId)->first();
            $serAddress->default = 1;
            $data = $serAddress->update();
            return $this->wrapSuccessReturn(compact('data'));
        }catch (\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }

    }
}