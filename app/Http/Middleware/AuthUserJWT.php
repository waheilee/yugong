<?php

namespace App\Http\Middleware;

use App\Constants\ErrorMsgConstants;
use App\Exceptions\ServiceException;
use Closure;
use Illuminate\Http\Request;

class AuthUserJWT
{

    protected $result = [
        "status_code"    => ErrorMsgConstants::TOKEN_ERROR,
        "message" => "登录过期!请尝试重新登录",
        "data"    => [],
    ];

    /**
     * Handle an incoming request.
     *
     * @param  Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $authUser = auth('user_api')->user();
            if (!isset($authUser)) {
                throw new ServiceException(ErrorMsgConstants::TOKEN_ERROR, "登录过期!请尝试重新登录");
            }
        } catch (\Exception $e) {
            return response($this->result, 200);
        }

        return $next($request);
    }
}
