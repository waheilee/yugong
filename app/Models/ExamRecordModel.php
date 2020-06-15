<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\ExamRecordModel
 *
 * @property int $id
 * @property int $ser_user_id 手艺人id
 * @property int $paper_id 试卷id
 * @property mixed $total 答题对错情况
 * @property float $score 考试得分
 * @property string $pass 是否通过
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamRecordModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamRecordModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamRecordModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamRecordModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamRecordModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamRecordModel wherePaperId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamRecordModel wherePass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamRecordModel whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamRecordModel whereSerUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamRecordModel whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamRecordModel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ExamRecordModel extends  Model
{

    protected $table = 'exam_record';
}