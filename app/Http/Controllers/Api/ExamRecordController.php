<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\ExamRecordModel;

class ExamRecordController extends Controller
{

    public function list()
    {
        try{
            $id = getAppUserUuid();
            $data = ExamRecordModel::whereSerUserId($id)->get();
            foreach ($data as $item){
                $item->total = json_decode($item->total);
            }
            return $this->wrapSuccessReturn(compact('data'));
        }catch (\Exception $exception){
            return$this->wrapErrorReturn($exception);
        }

    }
}