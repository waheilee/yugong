<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\PlanLessonModel;
use Illuminate\Http\Request;

class PlanLessonController extends Controller
{

    public function detail(Request $request)
    {
        $id = $request->input('plan_id');
        $planModel = PlanLessonModel::whereId($id)->first();
        return $planModel;

    }
}