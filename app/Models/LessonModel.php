<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LessonModel
 *
 * @property int $id
 * @property int $category_id 所属类别
 * @property string $title 课程标题
 * @property string|null $image 缩略图
 * @property string|null $intro 简介
 * @property string|null $content 课程大纲
 * @property int|null $sort 排序
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonModel whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonModel whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonModel whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonModel whereIntro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonModel whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonModel whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonModel whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Video[] $videos
 * @property-read int|null $videos_count
 * @property int $degree 难度系数：初级，中级，高级
 * @property string $views 观看学习人数
 * @property int $is_free 是否免费
 * @property int|null $price 价格
 * @property int|null $discounts 优惠价格
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonModel whereDegree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonModel whereDiscounts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonModel whereIsFree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonModel wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LessonModel whereViews($value)
 */
class LessonModel extends Model
{

    protected $table = 'lesson';

    public function videos()
    {
        return $this->hasMany(Video::class,'lesson_id','id');
    }



}