<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BannerModel
 *
 * @property int $id
 * @property string|null $title 轮播图标题
 * @property string|null $url 图片地址
 * @property int|null $type banner图类型
 * @property int|null $status 状态
 * @property string|null $content 内容：文章id、课程id、链接
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerModel whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerModel whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerModel whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerModel whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerModel whereUrl($value)
 * @mixin \Eloquent
 */
class BannerModel extends Model
{

    protected $table = 'exam_banner';
}