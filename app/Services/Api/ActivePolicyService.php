<?php

namespace App\Services\Api;


use App\Constants\ErrorMsgConstants;
use App\Exceptions\ServiceException;
use App\Models\Policy;
use App\Models\ServiceUserModel;

class ActivePolicyService
{

    /**
     * 激活码查看保单信息
     * @param $code
     * @return mixed
     */
    public function policyInfo($code)
    {
        $policyModel = Policy::whereCode($code)->first();
        $data['name'] = $policyModel->user_name;
        $data['phone'] = $policyModel->user_phone;
        $data['id_card'] = $policyModel->user_card_id;
        $data['code'] = $code;
        return $data;
    }

    /**
     * 确认激活保单
     * @param $code
     * @return bool|int
     */
    public function activePolicyConfirm($code)
    {
        $userId = getAppUserModel();
        $policyModel = Policy::whereCode($code)->first();
        $serUser = ServiceUserModel::whereId($userId->id)->first();
        $serUser->id_card = $policyModel->user_card_id;
        $serUser->update();
        $policyModel->is_active = 1;
        $policyModel->begin_time = date('Y-m-d');
        $policyModel->end_time = date('Y-m-d', strtotime('+ 30 days'));
        $policyModel->active_user_id = $userId->id;
        return $policyModel->update();
    }



}