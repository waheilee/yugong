<?php

namespace App\Http\Controllers\Api;


use App\Constants\ErrorMsgConstants;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Controller;
use App\Models\ExamPaperModel;
use App\Models\ExamRecordModel;

class ExamRecordController extends Controller
{

    public function list()
    {
        try{
            $id = getAppUserUuid();
            $data = ExamRecordModel::whereSerUserId($id)->get();
            if (!$data){
                throw new ServiceException(ErrorMsgConstants::VALIDATION_DATA_ERROR,'没有考试记录');
            }
            foreach ($data as $item){
                $paper = ExamPaperModel::whereId($item->paper_id)->first();
                $item['paper_name'] = $paper->title;
                $item->total = json_decode($item->total);
            }
            return $this->wrapSuccessReturn(compact('data'));
        }catch (\Exception $exception){
            return$this->wrapErrorReturn($exception);
        }

    }
}