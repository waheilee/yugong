<?php

namespace App\Http\Controllers\Api;


use App\Constants\ErrorMsgConstants;
use App\Exceptions\ServiceException;
use App\Http\Controllers\Controller;
use App\Models\ExamPaperModel;
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
                $lessonModel = LessonModel::whereCategoryId($categoryId)->get(['id','title','url','intro']);
                return $this->wrapSuccessReturn(compact('lessonModel'));
            } catch (\Exception $exception){
                return $this->wrapErrorReturn($exception);
            }
        }else{
            try{
                $lessonModel = LessonModel::all(['id','title','url','intro']);
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
            if (empty($lessonModel)){
                //无课程id返回值
                throw new ServiceException(ErrorMsgConstants::API_ERROR_MESSAGE, "课程不存在");
            }
            $examPaper = ExamPaperModel::whereLessonId($lessonModel->id)->first();
            if($examPaper){
                $paperId = $examPaper->id;
            }else{
                $paperId = null;
            }
            $lessonModel->increment('views');//浏览数
            $data = [
                'lesson'=>[
                    'id'=>$lessonModel->id,
                    'lesson_title'=>$lessonModel->title,
                    'url'=>$lessonModel->url,
                    'intro'=>$lessonModel->intro,
                    'content'=>$lessonModel->content,
                    'degree'=>$lessonModel->degree,
                    'is_free'=>$lessonModel->is_free,
                    'price'=>$lessonModel->price,
                    'discounts'=>$lessonModel->discounts,
                    'sections'=>getSectionList($lessonModel->sections()->get()),
                    'paper_id' => $paperId,
                    'views' => $lessonModel->views
                ],

            ];
            return $this->wrapSuccessReturn(compact('data'));
        } catch (\Exception $exception){
            return $this->wrapErrorReturn($exception);
        }
    }


}