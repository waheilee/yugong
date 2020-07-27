<?php

namespace App\Http\Controllers\User;


use Illuminate\Http\Request;

class WeChatOauthController
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
                'callback' => '/api/profit', //这个就是告诉授权要跳转到这个页面
            ],
        ];

        $this->app = \EasyWeChat\Factory::officialAccount(config('wechat.official_account'));

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \EasyWeChat\Kernel\Exceptions\RuntimeException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
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
}