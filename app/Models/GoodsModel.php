<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\GoodsModel
 *
 * @property int $id
 * @property int $category_id 商品所属分类
 * @property string $uuid 商品的uuid号
 * @property string $name 服务名称
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
 * @property string|null $deleted_at 是否上架
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsModel whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsModel whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsModel whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsModel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsModel whereFirstPinyin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsModel whereOriginalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsModel wherePictures($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsModel wherePinyin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsModel wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsModel whereSaleCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsModel whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsModel whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsModel whereTodayHasView($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsModel whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsModel whereViewCount($value)
 * @mixin \Eloquent
 */
class GoodsModel extends Model
{

    protected $table = 'goods';
}