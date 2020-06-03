<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Video
 *
 * @property int $id
 * @property string $title 视频标题
 * @property string $url 视频地址
 * @property int $views 浏览量
 * @property int $category_id 所属类别
 * @property string $tags 标签
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereViews($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Category $category
 * @property string $tag 标签
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereTag($value)
 * @property int|null $lesson_id 视频所属课程
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Video whereLessonId($value)
 * @property-read \App\Models\LessonModel|null $Lesson
 */
class Video extends Model
{
    protected $table = 'exam_videos';

    public function getTagAttribute($value)
    {
        return json_decode($value,true);
    }

    public function setTagAttribute($value)
    {
        $this->attributes['tag'] = implode(',', $value);
    }

    public function Lesson()
    {
        return $this->hasOne(LessonModel::class);
    }
}