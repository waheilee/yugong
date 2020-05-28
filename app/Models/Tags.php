<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tags
 *
 * @property int $id
 * @property string|null $category_id 标签所属分类id
 * @property string $tag 标签名称
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tags newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tags newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tags query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tags whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tags whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tags whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tags whereTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Tags whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tags extends Model
{
    protected $table = 'exam_tags';
}