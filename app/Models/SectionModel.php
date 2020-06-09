<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SectionModel
 *
 * @property int $id
 * @property int|null $lesson_id 章节所属课程id
 * @property string|null $title 章节名称
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SectionModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SectionModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SectionModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SectionModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SectionModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SectionModel whereLessonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SectionModel whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SectionModel whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\LessonModel|null $Lesson
 */
class SectionModel extends Model
{

    protected $table = 'section';

    public function Lesson()
    {
        return $this->hasOne(LessonModel::class);
    }
}