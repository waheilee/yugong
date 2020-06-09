<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ExamRoomModel
 *
 * @property int $id
 * @property string $title 考场标题
 * @property int $category_id 所属培训类别ID
 * @property string $exam_book 考试大纲
 * @property int $exam_status 考场状态，1为关闭，0为开启
 * @property string $intro 考场简介
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamRoomModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamRoomModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamRoomModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamRoomModel whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamRoomModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamRoomModel whereExamBook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamRoomModel whereExamStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamRoomModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamRoomModel whereIntro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamRoomModel whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamRoomModel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ExamRoomModel extends Model
{
    protected $table = 'exam_room';

}