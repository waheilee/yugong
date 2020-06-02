<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Policy;
use App\Services\Api\ActivePolicyService;
use Illuminate\Http\Request;

class ActivePolicyController extends Controller
{
    private $active;

    public function __construct(ActivePolicyService $policyService)
    {
        $this->active = $policyService;
    }

    /**
     * 激活码查看信息
     * @param Request $request
     * @return array
     */
    public function activeCode(Request $request)
    {
        try{
            $validatorRules = [
                'code'       => 'required',
            ];
            $validatorMessages = [
                'code.required'       => "激活码不能为空!",
            ];
            $this->requestValidator($request, $validatorRules, $validatorMessages);
            $code = $request->input('code');
            $data = $this->active->policyInfo(strtoupper($code));
            return $this->wrapSuccessReturn(compact('data'));
        } catch(\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }

    }

    public function activePolicy(Request $request)
    {
        try{
            $validatorRules = [
                'code'       => 'required',
//                'user_id' => 'required',

            ];
            $validatorMessages = [
                'code.required'       => "激活码不能为空!",
//                'user_id.required' => "激活用户Id不能为空!",
            ];
            $this->requestValidator($request, $validatorRules, $validatorMessages);
            $code = $request->input('code');
//            $userId = $request->input('user_id');
            $data = $this->active->activePolicyConfirm($code);
            return $this->wrapSuccessReturn(compact('data'));
        } catch(\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }
    }

    /**
     *  保单列表
     * @return Policy[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function policyList()
    {
        $userId = getAppUserModel();
        $policyModel = Policy::whereActiveUserId($userId->id)->get(['number','user_name','begin_time','end_time','type']);
        return $policyModel;
    }



}