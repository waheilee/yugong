<?php

namespace App\Http\Controllers;

use App\Constants\BaseConstants;
use App\Constants\ErrorMsgConstants;
use App\Exceptions\CustomException;
use App\Exceptions\ServiceException;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    protected $result = [
        "status_code" => BaseConstants::RETURN_SUCCESS,
        "message"     => "",
    ];

    protected function wrapSuccessReturn($responseData)
    {
        foreach ($responseData as $key => $value) {
            $this->result[$key] = $value;
        }

        return $this->result;
    }

    protected function wrapErrorReturn($exception,$responseData = null)
    {
        $logger = customerLoggerHandle("ErrorReturn");
        $logger->debug("接口异常", getExceptionMainInfo($exception));
        $this->result['status_code'] = BaseConstants::RETURN_ERROR;
        $this->result['message'] = ErrorMsgConstants::$errorMsg[ErrorMsgConstants::API_ERROR_MESSAGE];
        if ($exception instanceof ServiceException) {
            $this->result['message'] = $exception->getMessage();
        } elseif ($exception instanceof CustomException) {
            $this->result['status_code'] = $exception->getCode();
            $this->result['message'] = $exception->getMessage();
        }
        if (!empty($responseData)){
            foreach ($responseData as $key => $value) {
                $this->result[$key] = $value;
            }
        }else{
            $this->result['data'] = [];
        }

        return $this->result;
    }
    /**
     * 请求参数验证
     * @param Request $request
     * @param array $validatorRules 验证规则
     * @param array $validatorMessages 验证提示
     */
    protected function requestValidator(Request $request, array $validatorRules, array $validatorMessages = [])
    {
        $validator = Validator::make($request->all(), $validatorRules, $validatorMessages);
        if ($validator->fails()) {
            throw new ServiceException(ErrorMsgConstants::VALIDATION_DATA_ERROR, $validator->messages()->first());
        }
    }
}
