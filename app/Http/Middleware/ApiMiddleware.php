<?php

namespace App\Http\Middleware;

use Closure;
use \Illuminate\Support\Facades\Response;
class ApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $requestKey = md5(json_encode($request->all()) . time() . rand(111111, 999999));
        $monolog = customerLoggerHandle('api');
        $monolog->info($request->getPathInfo() . "[request][$requestKey]", $request->all());
        $monolog->info($request->getPathInfo() . "[header][$requestKey]", $request->header());

        $headers = [
            'Access-Control-Allow-Origin'  => '*',
            'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS',
            'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin, X-Requested-With, content-type, Authorization',
            'Access-Control-Max-Age'       => '1728000',
        ];

        if ($request->getMethod() == "OPTIONS") {
            return Response::make('OK', 204, $headers);
        }

        $response = $next($request);
        foreach ($headers as $key => $value) {
            $response->header($key, $value);
        }

        if (is_array(json_decode($response->content(), true))) {
            $monolog->info($request->getPathInfo() . "[Response][$requestKey]", json_decode($response->content(), true));
        } else {
            $monolog->info($request->getPathInfo() . "[Response][$requestKey]", [$response->content()]);
        }
        $monolog->info("=============================================================");

        return $response;
    }
}
