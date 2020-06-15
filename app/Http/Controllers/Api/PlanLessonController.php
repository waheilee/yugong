<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\PlanLessonModel;
use Illuminate\Http\Request;

class PlanLessonController extends Controller
{

    public function list()
    {
        try{
            $data = PlanLessonModel::whereStatus(1)->get(['id','title','time','num_people','url']);
            return $this->wrapSuccessReturn(compact('data'));
        }catch(\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }
    }

    public function detail(Request $request)
    {
        try{
            $id = $request->input('plan_id');
            $data = PlanLessonModel::whereId($id)->first();
//            return $planModel;
            return $this->wrapSuccessReturn(compact('data'));
        }catch(\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }


    }
}