<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\LessonModel;
use App\Models\Video;
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

            $data = [
                'lesson'=>[
                    'id'=>$lessonModel->id,
                    'lesson_title'=>$lessonModel->title,
                    'image'=>$lessonModel->image,
                    'intro'=>$lessonModel->intro,
                    'content'=>$lessonModel->content,
                    'degree'=>$lessonModel->degree,
                    'is_free'=>$lessonModel->is_free,
                    'price'=>$lessonModel->price,
                    'discounts'=>$lessonModel->discounts,
                    'sections'=>$this->getSectionList($lessonModel->sections()->get())
                ],

            ];
            return $this->wrapSuccessReturn(compact('data'));
        } catch (\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }
    }

    protected function getSectionList($sections)
    {
        $data = [];
        foreach ($sections as $section){
            $video = Video::whereSectionId($section->id)->get(['id','title','url']);
            $item = [];
            $item['section_title'] = $section->title;
            $item['videos'] = $video;
            $data[] = $item;
        }
        return $data;
    }
}