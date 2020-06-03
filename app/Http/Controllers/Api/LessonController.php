<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\LessonModel;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * 获取课程列表
     * @param Request $request
     * @return array
     */
    public function lessonList(Request $request)
    {
        $categoryId = $request->input('category_id');
        if ($categoryId){
            try{
                $lessonModel = LessonModel::whereCategoryId($categoryId)->get(['id','title','image','intro']);
                return $this->wrapSuccessReturn(compact('lessonModel'));
            } catch (\Exception $exception){
                return $this->wrapErrorReturn($exception);
            }
        }else{
            try{
                $lessonModel = LessonModel::all(['id','title','image','intro']);
                return $this->wrapSuccessReturn(compact('lessonModel'));
            } catch (\Exception $exception){
                return $this->wrapErrorReturn($exception);
            }
        }

    }

    /**
     * 课程详情接口
     * @param Request $request
     * @return array
     */
    public function lessonDetail(Request $request)
    {
        try {
            $validatorRules = [
                'lesson_id' => 'required',
            ];

            $validatorMessages = [
                'lesson_id.required' => "课程id不能为空!",
            ];
            $this->requestValidator($request, $validatorRules, $validatorMessages);
            $id = $request->input('lesson_id');
            $lessonModel = LessonModel::whereId($id)->first();
            $lessonModel->videos;
            $data['lesson'] = $lessonModel;

            return $this->wrapSuccessReturn(compact('lessonModel'));
        } catch (\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }


    }
}