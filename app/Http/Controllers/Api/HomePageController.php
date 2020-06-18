<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\BannerModel;
use App\Models\LessonModel;
use App\Models\NavModel;
use App\Models\PlanLessonModel;

class HomePageController extends Controller
{

    public function index()
    {
        try{
            $banner = BannerModel::whereStatus(1)->orderBy('created_at','desc')->get(['title','url','content','type']);
            $plan   = PlanLessonModel::whereStatus(1)->limit(3)->get(['id','title','url']);
            $nav    = NavModel::whereStatus(1)->limit(5)->get(['id','title','img_url']);
            $lesson = LessonModel::orderByDesc('created_at')->limit(3)->get(['id','title','image']);
            $data = [
                'indexData' =>[
                    'banner'=>$banner,
                    'recommend'=>$plan,
                    'nav' =>$nav,
                    'lesson'=>$lesson
                ]
            ];
            return $this->wrapSuccessReturn(compact('data'));
        }catch (\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }

    }
}