<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WeChatController extends  Controller
{
    private $app;
    public function __construct()
    {
        $config = [
            'app_id' => 'wx2e08b0303bde9168',
            'secret' => '93bc89a7b99b5a872733fa52b8ac5b6c',
            'token' => 'hangzhouydhb',
            'response_type' => 'array',
            'oauth' => [
                'scopes'   => ['snsapi_userinfo'],
                'callback' => 'https://store.yd-hb.com/profit', //这个就是告诉授权要跳转到这个页面
            ],
        ];

        $this->app = \EasyWeChat\Factory::officialAccount(config('wechat.official_account.default'));

    }

    /**
     * @param Request $request

     */
    public function buy(Request $request)
    {
        $url = "https://store.yd-hb.com/profit";
        $url2 = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx2e08b0303bde9168&redirect_uri=".$url."&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect";
        header('Location:'.$url2);
    }

    public function  profit($code){
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx2e08b0303bde9168&secret=93bc89a7b99b5a872733fa52b8ac5b6c&code=".$code."&grant_type=authorization_code";

        //$json=file_get_contents($url);//获取ACCESS_TOKEN

        $ch = curl_init();
        @curl_setopt($ch, CURLOPT_URL, $url);
        @curl_setopt($ch, CURLOPT_HEADER, 0);
        @curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        @curl_setopt($ch, CURL_SSLVERSION_SSL, 2);
        @curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        @curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        $json = curl_exec($ch);

        $json = json_decode($json,true);
        dd($json);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \EasyWeChat\Kernel\Exceptions\BadRequestException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \ReflectionException
     */
    public function serve()
    {
        $this->app->server->push(function($message){
            return "欢迎关注愚公帮帮";
        });
        return $this->app->server->serve();
    }


}