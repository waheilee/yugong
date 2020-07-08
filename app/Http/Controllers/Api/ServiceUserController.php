<?php

namespace App\Http\Controllers\Api;


use App\Constants\ErrorMsgConstants;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Controller;
use App\Models\ServiceUserModel;
use App\Services\Api\SerUserService;
use App\Services\VerificationCodeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Jxlwqq\IdValidator\IdValidator;

class ServiceUserController extends Controller
{

    private $serUserService;

    public function __construct(SerUserService $serUserService)
    {
        $this->serUserService = $serUserService;
    }

    /**
     * 用户登录接口
     * @param Request $request
     * @return array
     */
    public function login(Request $request)
    {
        try {
            $validatorRules = [
                'phone'       => 'required',
                'password'   => 'required',
            ];

            $validatorMessages = [
                'name.required'       => "账户不能为空!",
                'password.required'   => "密码不能为空!",
            ];

            $this->requestValidator($request, $validatorRules, $validatorMessages);

            $name = $request->input('phone');
            $password = $request->input('password');
            $data = $this->serUserService->login($name, $password);
            return $this->wrapSuccessReturn(compact('data'));
        } catch (\Exception $exception) {
            return $this->wrapErrorReturn($exception);
        }
    }

    /**
     * 用户注册接口
     * @param Request $request
     * @return array
     */
    public function register(Request $request)
    {
        try {
            $validatorRules = [
                'password'      => 'required',  //登录密码
                'phone'         => 'required',//手机号
                'code'         => 'required',//手机号
            ];
            $validatorMessages = [
                'password.required'      => "密码不能为空!",
                'phone.required'         => "手机号不能为空!",
                'code.required'         => "验证码不能为空!",
            ];
            $this->requestValidator($request, $validatorRules, $validatorMessages);
            $password = $request->input('password');
            $phone = $request->input('phone');
            $code = $request->input('code');
            /**
             * 验证短信验证码
             * @var VerificationCodeService $verificationCodeService
             */
//            $verificationCodeService = app(VerificationCodeService::class);
//            $verificationCodeService->checkVerificationCode($phone, $code);

            $data = $this->serUserService->register($password, $phone);

            return $this->wrapSuccessReturn(compact('data'));
        } catch (\Exception $exception) {
            return $this->wrapErrorReturn($exception);
        }

    }

    /**
     * 验证码发送
     * @param Request $request
     * @return array
     */
    public function loginSendCode(Request $request)
    {
        try {

            $validatorRules = [
                'phone' => 'required', //用户名
            ];

            $validatorMessages = [
                'phone.required' => "手机号不能为空错误!",
            ];

            $this->requestValidator($request, $validatorRules, $validatorMessages);

            $phone = $request->input('phone');

            $data = $this->serUserService->loginSendCode($phone);

            return $this->wrapSuccessReturn(compact('data'));
        } catch (\Exception $exception) {
            return $this->wrapErrorReturn($exception);
        }
    }

    /**
     * 安全登出接口
     * @return array
     */
    public function logout()
    {
        try {
            auth('api')->logout(true);
            $data = true;
            return $this->wrapSuccessReturn(compact('data'));
        } catch (\Exception $exception) {
            return $this->wrapErrorReturn($exception);
        }
    }

    /**
     * 服务人员用户详情接口
     * @return array
     */
    public function userInfo()
    {
        try {

            $data = $this->serUserService->userInfo();
            return $this->wrapSuccessReturn(compact('data'));
        } catch (\Exception $exception) {
            return $this->wrapErrorReturn($exception);
        }
    }

    /**
     * 修改密码
     * @param Request $request
     * @return array
     */
    public function changePass(Request $request)
    {
        try{
            $validatorRules = [
                'password'      => 'required',  //密码
                'new_pass'   => 'required',//新摩玛

            ];
            $validatorMessages = [
                'password.required'      => "密码不能为空!",
                'new_pass.required'   => "新密码不能为空",
            ];
            $this->requestValidator($request, $validatorRules, $validatorMessages);
            $oldPass = $request->input('password');
            $newPass = $request->input('new_pass');
            $serUserPass = getAppUserModel()->password;
            if (md5($oldPass) !=$serUserPass){
                throw new ServiceException(ErrorMsgConstants::DEFAULT_ERROR, "密码不正确");
            }
            $data = $this->serUserService->userPassChange($newPass);
            return $this->wrapSuccessReturn(compact('data'));
        }catch (\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }
    }

    /**
     * 验证身份证号码
     * @param Request $request
     * @return array
     */
    public function idValidator(Request $request)
    {
        try{
            $validatorRules = [
                'id_num'      => 'required',  //密码
            ];
            $validatorMessages = [
                'id_num.required'      => "身份证号码不能为空",
            ];
            $this->requestValidator($request, $validatorRules, $validatorMessages);
            $idNum = $request->input('id_num');
            $idValidator = new IdValidator();
            $data = $idValidator->isValid($idNum);
//            dd($data);
            return $this->wrapSuccessReturn(compact('data'));
        }catch (\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }

    }

    /**
     * 头像上传修改
     * @param Request $request
     * @return array
     */
    public function setAvatar(Request $request)
    {
        try{
            $image = $request->input('avatar'); // image base64 encoded
            $base =  preg_match("/data:image\/(.*?);/",$image,$image_extension); // extract the image extension
            $image = preg_replace('/data:image\/(.*?);base64,/','',$image); // remove the type part
            $image = str_replace(' ', '+', $image);
            if (!$base){
                throw new ServiceException(ErrorMsgConstants::VALIDATION_DATA_ERROR,'上传的base64图片格式有误');
            }
            $imageName = 'avatar/'.date('Y-m-d') . uniqid() . '.' . $image_extension[1]; //generating unique file name;
            Storage::disk('qiniu')->put($imageName,base64_decode($image));
            $serId = getAppUserUuid();
            $serModel = ServiceUserModel::whereId($serId)->first();
            $serModel->avatar = env('QINIU_URL').$imageName;
            $data = $serModel->update();
            return $this->wrapSuccessReturn(compact('data'));
        }catch (\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }


    }
}