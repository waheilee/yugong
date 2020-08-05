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
        try{
            $userId = getAppUserModel();
            $policyModel = Policy::whereActiveUserId($userId->id)->get(['number','user_name','begin_time','end_time','type']);
            return $this->wrapSuccessReturn(compact('policyModel'));
        }catch (\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }

    }

    public function createPolicy(Request $request)
    {
        try{
            $validatorRules = [
                'name'       => 'required',
                'phone'      => 'required',
                'id_card'    => 'required',
                'email'      => 'required|email',

            ];
            $validatorMessages = [
                'name.required'       => "姓名不能为空!",
                'phone.required'      => "电话不能为空!",
                'id_card.required'    => "身份证号不能为空!",
                'email.required'      => "邮箱不能为空!",
            ];
            $this->requestValidator($request, $validatorRules, $validatorMessages);
            $name   = $request->input('name');
            $phone  = $request->input('phone');
            $idCard = $request->input('id_card');
            $email  = $request->input('email');
            $policyModel = new Policy();
            $policyModel->user_name    = $name;
            $policyModel->user_phone   = $phone;
            $policyModel->user_card_id = $idCard;
            $policyModel->email        = $email;
            $data = $policyModel->save();
            return $this->wrapSuccessReturn(compact('data'));
        } catch(\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }
    }


}