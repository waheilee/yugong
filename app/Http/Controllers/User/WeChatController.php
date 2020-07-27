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

        $this->app = \EasyWeChat\Factory::officialAccount($config);
    }


    public function buy(Request $request){
        if(empty(session('wechat_user'))){
            $oauth = $this->app->oauth;
            session(['target_url'=>'/buy']);
            return $oauth->redirect();
        }
        $user = session('wechat_user');
        dd($user);
        $skd = $this->app->jssdk->buildConfig(['updateAppMessageShareData', 'updateTimelineShareData'],$debug = false, $beta = false, $json = true);
        $url = "https://store.yd-hb.com/api/buy";
        $this->app->jssdk->setUrl($url);

        return view('share',compact('skd','user'));
    }

    public function  profit(){
        $oauth = $this->app->oauth;
        $user = $oauth->user();
        session(['wechat_user'=>$user->toArray()]);
        $target_url = empty(session('target_url'))?'/':session('target_url');
        header('Location:'.$target_url);
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