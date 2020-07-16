<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;
/**
 * App\Models\ServerTempModel
 *
 * @property int $id
 * @property int $category_id 商品所属分类
 * @property string $uuid 商品的uuid号
 * @property string $name
 * @property string $title 简短的描述
 * @property float $price 商品的价格
 * @property float $original_price 商品原本的价格
 * @property string $thumb 商品的缩略图
 * @property string|null $pictures 图片的列表
 * @property int $view_count 商品的浏览次数
 * @property int $today_has_view 今日是否有浏览量
 * @property int $sale_count 出售的数量
 * @property int $count 商品库存量
 * @property string|null $pinyin 商品名的拼音
 * @property string|null $first_pinyin 商品名的拼音的首字母
 * @property string|null $content 商品的描述
 * @property int|null $ser_user_id 商品所属服务者id
 * @property int|null $exam_id 所需通过试卷ID
 * @property \Illuminate\Support\Carbon|null $deleted_at 是否上架
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerTempModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerTempModel newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ServerTempModel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerTempModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerTempModel whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerTempModel whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerTempModel whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerTempModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerTempModel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerTempModel whereExamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerTempModel whereFirstPinyin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerTempModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerTempModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerTempModel whereOriginalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerTempModel wherePictures($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerTempModel wherePinyin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerTempModel wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerTempModel whereSaleCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerTempModel whereSerUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerTempModel whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerTempModel whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerTempModel whereTodayHasView($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerTempModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerTempModel whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServerTempModel whereViewCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ServerTempModel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ServerTempModel withoutTrashed()
 * @mixin \Eloquent
 */
class ServerTempModel extends Model
{
    use SoftDeletes;
    protected $table = 'servers_template';
    public static $addToSearch = true;
    public function getThumbAttribute($thumb)
    {
        return assertUrl($thumb);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
//    public function getRouteKeyName()
//    {
//        return 'uuid';
//    }
//    public static function boot()
//    {
//        parent::boot();
//        // 自动生成商品的 uuid， 拼音
//        static::saving(function (ServerTempModel $model) {
//
//            if (is_null($model->uuid)) {
//                $model->uuid = Uuid::uuid4()->toString();
//            }
//        });
//    }
}