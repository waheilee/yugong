<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PlanLessonModel
 *
 * @property mixed $column_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanLessonModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanLessonModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanLessonModel query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $title 计划课程名称
 * @property string|null $student 规划学习人群或计划公司员工
 * @property string|null $time 课时总时长
 * @property int|null $num_people 学习人数
 * @property string|null $grade 课程评分
 * @property string|null $content 课程介绍
 * @property mixed|null $lesson 课程计划下所有课程
 * @property string|null $url 计划课程封面
 * @property int $status 计划课程状态
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanLessonModel whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanLessonModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanLessonModel whereGrade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanLessonModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanLessonModel whereLesson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanLessonModel whereNumPeople($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanLessonModel whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanLessonModel whereStudent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanLessonModel whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanLessonModel whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanLessonModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PlanLessonModel whereUrl($value)
 */
class PlanLessonModel extends Model
{

    protected $table = 'exam_plan';

    public function getLessonAttribute($value)
    {
        return array_values(json_decode($value, true) ?: []);
    }

    public function setLessonAttribute($value)
    {
//        dd($this->getLessonDetail(array_values($value)));
        $this->attributes['lesson'] = json_encode($this->getLessonDetail(array_values($value)));
    }

    public function getLessonDetail($value)
    {
        $temp = [];
        foreach ($value as $item=>$k)
        {
            $arr = [];
            $lessonModel = LessonModel::whereId($k['lesson_id'])->first();
            $examPaper = ExamPaperModel::whereLessonId($lessonModel->id)->first();
            if (!$examPaper){
                $paperId = '没有试卷';

            }else{
                $paperId = $examPaper->id;
            }
            $arr['stage'] = $k['stage'];
            $arr['lesson'] = [
                'id'=>$lessonModel->id,
                'lesson_title'=>$lessonModel->title,
                'image'=>$lessonModel->image,
                'intro'=>$lessonModel->intro,
                'content'=>$lessonModel->content,
                'degree'=>$lessonModel->degree,
                'is_free'=>$lessonModel->is_free,
                'price'=>$lessonModel->price,
                'discounts'=>$lessonModel->discounts,
                'sections'=>getSectionList($lessonModel->sections()->get()),
                'paper_id' => $paperId
            ];
            $temp[] = $arr;
        }
        return $temp;
    }
}