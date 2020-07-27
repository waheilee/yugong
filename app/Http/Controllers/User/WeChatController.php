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
        // https://open.weixin.qq.com/connect/oauth2/authorize?appid=你的公众appId号&redirect_uri=你的回调路由&response_type=code&scope=你选择的方式&state=STATE#wechat_redirect

//        if(empty(session('wechat_user'))){
//            $oauth = $this->app->oauth;
////            dd($oauth);
//            session(['target_url'=>'/buy']);
//            return $oauth->redirect();
//        }
        // 未登录
        if (empty($_SESSION['wechat_user'])) {

            $_SESSION['target_url'] = '/profile';

            return $this->app->oauth->redirect();
            // 这里不一定是return，如果你的框架action不是返回内容的话你就得使用
            // $oauth->redirect()->send();
        }
        $user = $_SESSION['wechat_user'];
//        dd($user);
//        $skd = $this->app->jssdk->buildConfig(['updateAppMessageShareData', 'updateTimelineShareData'],$debug = false, $beta = false, $json = true);
//        $url = "https://store.yd-hb.com/api/buy";
//        $this->app->jssdk->setUrl($url);
//
//        return view('share',compact('skd','user'));
    }

    public function  profit(){
        $oauth = $this->app->oauth;
        $user = $oauth->user();
        $_SESSION['wechat_user'] = $user->toArray();
        $targetUrl = empty($_SESSION['target_url']) ? '/' : $_SESSION['target_url'];
        header('Location:'.$targetUrl);
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