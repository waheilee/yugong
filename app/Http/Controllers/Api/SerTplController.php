<?php

namespace App\Http\Controllers\Api;


use App\Constants\ErrorMsgConstants;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Controller;
use App\Models\ExamPaperModel;
use App\Models\ExamRecordModel;
use App\Models\ServerTempModel;
use Illuminate\Http\Request;

class SerTplController extends Controller
{

    //获取服务
    public function serverList()
    {
        try{
            $data = ServerTempModel::all();
            if (!$data){
                throw new ServiceException(ErrorMsgConstants::VALIDATION_DATA_ERROR,'暂无服务');
            }
            return $this->wrapSuccessReturn(compact('data'));
        }catch (\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }
    }

    //换取服务

    /**
     * @param Request $request
     * @return array
     */
    public function getServer(Request $request)
    {
        try{
            $examId    = $request->input('exam_id');
            $serverId  = $request->input('server_id');
            $serTplModel = ServerTempModel::whereId($serverId)->first();
            if (!$serTplModel){
                throw new ServiceException(ErrorMsgConstants::VALIDATION_DATA_ERROR,'暂无服务');
            }
            $serUserId = getAppUserModel()->id;
            $examModel = ExamRecordModel::whereSerUserId($serUserId)->wherePaperId($examId)->wherePass(1)->first();
            if (!$examModel){
                $paperModel = ExamPaperModel::whereId($examId)->first();
                throw new ServiceException(ErrorMsgConstants::VALIDATION_DATA_ERROR,'您还未通过'.$paperModel->title.'测试！');
            }
//            dd($serTplModel->category_id);

            $serverTempModel = new ServerTempModel();
            $serverTempModel->uuid             = generateNewUuid();
            $serverTempModel->category_id      = $serTplModel->category_id;
            $serverTempModel->name             = $serTplModel->name;
            $serverTempModel->title            = $serTplModel->title;
            $serverTempModel->price            = $serTplModel->price;
            $serverTempModel->original_price   = $serTplModel->original_price;
            $serverTempModel->thumb            = $serTplModel->thumb;
            $serverTempModel->count            = $serTplModel->count;
            $serverTempModel->content          = $serTplModel->content;
            $serverTempModel->exam_id          = $serTplModel->exam_id;
            $serverTempModel->ser_user_id      = $serUserId;
            $serverTempModel->save();
            $data = '成功获取服务';
            return $this->wrapSuccessReturn(compact('data'));
        }catch (\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }
    }

    public function myServer()
    {
        try{
            $serUserId = getAppUserModel()->id;
            $data = ServerTempModel::whereSerUserId($serUserId)->get();
            if ($data->isEmpty()){
                throw new ServiceException(ErrorMsgConstants::VALIDATION_DATA_ERROR,'对不起，暂时还没有获得任何服务项目');
            }
            return $this->wrapSuccessReturn(compact('data'));
        }catch (\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }

    }
}