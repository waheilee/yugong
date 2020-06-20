<?php

namespace App\Http\Controllers\Api;


use App\Constants\ErrorMsgConstants;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Controller;
use App\Models\CertificateModel;
use App\Models\ExamRecordModel;
use App\Models\SerUserCertificateModel;
use Illuminate\Http\Request;

class CertificateController extends Controller
{

    public function cerList()
    {
        try{
            $data = CertificateModel::all(['title','id','url']);
            return $this->wrapSuccessReturn(compact('data'));
        }catch (\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }
    }

    public function getCertificate(Request $request)
    {
        try{
            $cerId = $request->input('cer_id');
            $serUserId = getAppUserModel()->id;
            $cerModel = CertificateModel::whereId($cerId)->first();
            $cerRecord = SerUserCertificateModel::whereSerUserId($serUserId)->whereCertificateId($cerModel->id)->first();
            if ($cerRecord){
                throw new ServiceException(ErrorMsgConstants::VALIDATION_DATA_ERROR,'您已领取过该证书');
            }
            if (!$cerModel){
                throw new ServiceException(ErrorMsgConstants::VALIDATION_DATA_ERROR,'没有证书');
            }
            $require =  json_decode($cerModel->require);
            $record = ExamRecordModel::whereSerUserId($serUserId)->wherePass(1)->get();
            $arr = [];//查找出用户通过考试的所有试卷id
            foreach ($record as $item=>$v){
                $arr[$item] = $v->paper_id;
            }
            $array = [];
            //通过用户考试通过的所有试卷id和证书所需要通过试卷id对比，返回改用户通过了哪些科目情况
            foreach ($require as $item=>$vv){
                foreach ($arr as $temp =>$value){
                    if ($vv == $value){
                        $array[$vv] = true;
                        break;
                    }else{
                        $array[$vv] = false;

                    }
                }
            }

            $flag = false;
            //循环判断是否全部通过好事科目，通过则兑换证书，未通过则返回试卷id对应通过情况
            foreach ($array as $value){
                if ($value != true){
                    $flag = true;
                    break;
                }
            }
            if ($flag) {
                $data =  $array;
            }else{
            $serUserCer = new SerUserCertificateModel();
            $serUserCer->ser_user_id = getAppUserModel()->id;
            $serUserCer->certificate_id = $cerModel->id;
            $serUserCer->save();
            $data = $cerModel->url;
            }
            return $this->wrapSuccessReturn(compact('data'));
        }catch (\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }


    }
}