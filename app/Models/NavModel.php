<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\NavModel
 *
 * @property int $id
 * @property string $title 标题
 * @property string $img_url 图标地址
 * @property int $status 状态
 * @property string $content 内容
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NavModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NavModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NavModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NavModel whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NavModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NavModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NavModel whereImgUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NavModel whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NavModel whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NavModel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class NavModel extends Model
{

    protected $table = 'exam_nav';
}