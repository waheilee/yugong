<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ExamPaperModel
 *
 * @property int $id
 * @property int $lesson_id 试卷所属考场
 * @property string $title 试卷标题
 * @property int $timeout 考试所需时间
 * @property int $pass 及格线
 * @property mixed $question 试题
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamPaperModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamPaperModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamPaperModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamPaperModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamPaperModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamPaperModel wherePass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamPaperModel whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamPaperModel whereLessonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamPaperModel whereTimeout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamPaperModel whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamPaperModel whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read int|null $question_count
 */
class ExamPaperModel extends Model
{

    protected $table = 'exam_paper';

    public function question()
    {
        return $this->belongsToMany(Question::class);
    }
}