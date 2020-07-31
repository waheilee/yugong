<?php
/**
 * 暂时无用
 */
namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yansongda\Pay\Pay;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \EasyWeChat\Kernel\Exceptions\RuntimeException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function buy(Request $request)
    {
//        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
//            $url = "https://store.yd-hb.com/profit";
//            $url2 = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx2e08b0303bde9168&redirect_uri=".$url."&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect";
//            header('Location:'.$url2);
////            return '这是微信流浪器';
//        } else {
//            return '这是网页';
//        }

        if(empty(session('wechat_user'))){
            $oauth = $this->app->oauth;
            session(['target_url'=>'/buy']);
            return $oauth->redirect();
        }
        $user = session('wechat_user');
        //dd($user);
        $skd = $this->app->jssdk->buildConfig(['updateAppMessageShareData', 'updateTimelineShareData'],$debug = false, $beta = false, $json = true);
        $url = "store.yd-hb.com/buy";
        $this->app->jssdk->setUrl($url);

        return view('share',compact('skd','user'));
    }

    public function  profit(){
        //$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx2e08b0303bde9168&secret=93bc89a7b99b5a872733fa52b8ac5b6c&code=".$_GET['code']."&grant_type=authorization_code";

        //$json=file_get_contents($url);//获取ACCESS_TOKEN

//        $ch = curl_init();
//        @curl_setopt($ch, CURLOPT_URL, $url);
//        @curl_setopt($ch, CURLOPT_HEADER, 0);
//        @curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        @curl_setopt($ch, CURL_SSLVERSION_SSL, 2);
//        @curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
//        @curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
//        $json = curl_exec($ch);
//
//        $json = json_decode($json,true);
//        dd($json);

        $oauth = $this->app->oauth;
        $user = $oauth->user();
        dd($user);
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

    /**
     * 微信支付
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function weChatPay($id)
    {
//        dd(123);
//        $serverOrderId = $request->input('order_id');
        $orderModel = OrderModel::whereId($id)->first();
        $order = [
            'out_trade_no' => time(),
            'body' => $orderModel->title,
            'total_fee' => $orderModel->pay_money,
        ];
        $result = Pay::wechat(config('pay.wechat'))->wap($order);
        $json =  $result->getContent();
        dd(json_decode($json));
        $res = json_decode($json);
        return $res;//返回支付参数
        //return Pay::wechat(config('pay.wechat'))->wap($order)->send(); // laravel 框架中请直接 return $wechat->wap($order)
    }

    /**
     * 微信回调
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Yansongda\Pay\Exceptions\InvalidArgumentException
     */
    public function notify(Request $request)
    {
        try{
            $result = Pay::wechat(config('pay.wechat'))->verify();
            customerLoggerHandle("WeChatNotify")->debug('微信回调通知',$result->all());
//            Log::debug('wechat notify',$result->all());
        }catch (\Exception $exception){
            return Pay::wechat(config('pay.wechat'))->success();

        }
    }

}