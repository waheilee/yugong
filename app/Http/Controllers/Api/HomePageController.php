<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\BannerModel;
use App\Models\PlanLessonModel;

class HomePageController extends Controller
{

    public function index()
    {
        $banner = BannerModel::whereStatus(1)->orderBy('created_at','desc')->get(['title','url','content','type']);
        $plan = PlanLessonModel::whereStatus(1)->get(['id','title','url']);
        foreach ($plan as $item){
            $item->url = env('APP_URL').$item->url;
        }
        $data = [
            'indexData' =>[
                'banner'=>$banner,
                'recommend'=>$plan,
            ]
        ];
        return $data;

    }
}