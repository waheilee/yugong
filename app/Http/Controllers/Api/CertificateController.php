<?php

namespace App\Http\Controllers\Api;


use App\Constants\ErrorMsgConstants;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Controller;
use App\Models\CertificateModel;
use App\Models\ExamPaperModel;
use App\Models\ExamRecordModel;
use App\Models\SerUserCertificateModel;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    /**
     * 所有证书列表
     * @return array
     */
    public function cerList()
    {
        try{
            $cer = CertificateModel::all(['id','title','url','icon_url']);
            if (!$cer){
                throw new ServiceException(ErrorMsgConstants::VALIDATION_DATA_ERROR,'暂无证书');
            }
            $userId = getAppUserModel()->id;
            $serCer = SerUserCertificateModel::whereSerUserId($userId)->get();
            if (empty($serCer)){
                throw new ServiceException( ErrorMsgConstants::VALIDATION_DATA_ERROR,'我的证书不存在');
            }
            $data = [];
            foreach ($serCer as $item){
                $certificate = CertificateModel::whereId($item->certificate_id)->first(['id','title','url','icon_url','created_at']);
                if (!$certificate){
                    throw new ServiceException( ErrorMsgConstants::VALIDATION_DATA_ERROR,'证书不存在');
                }
                $data['my_certificate'][] = $certificate;


            }
            foreach ($cer as $k=>$v){
                foreach ($serCer as $item=>$i){
                    if ($v->id == $i->certificate_id){
                        unset($cer[$k]);
                    }
                }
            }
            foreach ($cer as  $k=>$v){
                $data['cer'][] = $v;
            }
            return $this->wrapSuccessReturn(compact('data'));
        }catch (\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }
    }

    /**
     * 换取证书
     * @param Request $request
     * @return array
     */
    public function getCertificate(Request $request)
    {
        try{
            $cerId = $request->input('cer_id');
            $serUserId = getAppUserModel()->id;
            $cerModel = CertificateModel::whereId($cerId)->first();
            if (!$cerModel){
                $data =[];
                throw new ServiceException(ErrorMsgConstants::VALIDATION_DATA_ERROR,'没有证书');
            }
            $cerRecord = SerUserCertificateModel::whereSerUserId($serUserId)->whereCertificateId($cerModel->id)->first();
            if ($cerRecord){
                $data =[];
                throw new ServiceException(ErrorMsgConstants::VALIDATION_DATA_ERROR,'您已领取过该证书');
            }

            $require =  json_decode($cerModel->require);
            $record = ExamRecordModel::whereSerUserId($serUserId)->wherePass(1)->get();
            if ($record->isEmpty()){
                $data = [];
                foreach (json_decode($cerModel->require) as $k=>$v){
                    $exam = ExamPaperModel::whereId($v)->first(['id','title']);
                    $data[] = $exam;
                }
                throw new ServiceException(ErrorMsgConstants::VALIDATION_DATA_ERROR,'还有科目未考过');
            }
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
                $data = [];
                foreach ($array as $k=>$v){
                    if ($v ==false){
                        $exam = ExamPaperModel::whereId($k)->first(['id','title']);
                        $data[] = $exam;
                    }
                }
                throw new ServiceException(ErrorMsgConstants::VALIDATION_DATA_ERROR,'还有科目未考过');
            }else{
            $serUserCer = new SerUserCertificateModel();
            $serUserCer->ser_user_id = getAppUserModel()->id;
            $serUserCer->certificate_id = $cerModel->id;
            $serUserCer->save();
            $data = $cerModel->url;
            }
            return $this->wrapSuccessReturn(compact('data'));
        }catch (\Exception $exception){
            return $this->wrapErrorReturn($exception,compact('data'));
        }


    }

    /**
     * 我的证书列表
     * @return array
     * 该功能作废
     */
    public function myCertificateList()
    {
        try{
            $userId = getAppUserModel()->id;
            $serCer = SerUserCertificateModel::whereSerUserId($userId)->get();
            if (empty($serCer)){
                throw new ServiceException( ErrorMsgConstants::VALIDATION_DATA_ERROR,'我的证书不存在');
            }
            $data = [];
            foreach ($serCer as $item){
                $certificate = CertificateModel::whereId($item->certificate_id)->first(['id','url','created_at','icon_url']);
                if (!$certificate){
                    throw new ServiceException( ErrorMsgConstants::VALIDATION_DATA_ERROR,'证书不存在');
                }
                $data[] = $certificate;
            }

            return $this->wrapSuccessReturn(compact('data'));
        }catch (\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }
    }

    /**
     * 换取纸质证书
     * @param Request $request
     */

    public function exchangePaperCertificate(Request $request)
    {
        $cerId = $request->input('cer_id');
        $certificateModel = CertificateModel::whereId($cerId)->first();

    }
}