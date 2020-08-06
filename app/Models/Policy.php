<?php

namespace App\Models;


use App\Jobs\SendPolicyCode;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Policy
 *
 * @property int $id
 * @property string|null $user_name 姓名
 * @property string|null $user_phone 电话
 * @property string|null $user_card_id 身份证号
 * @property string|null $code 激活码
 * @property int $is_active 是否激活.0为未激活，1为激活
 * @property string|null $number 保单号
 * @property string|null $begin_time 有效期起始时间
 * @property string|null $end_time 有效期结束时间
 * @property int|null $type 险种
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy whereBeginTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy whereUserCardId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy whereUserName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy whereUserPhone($value)
 * @mixin \Eloquent
 * @property string|null $active_user_id 激活用户ID
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy whereActiveUserId($value)
 * @property string|null $email 邮箱
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Policy whereEmail($value)
 */
class Policy extends Model
{
    protected $fillable = ['user_name', 'user_phone','user_card_id','code','type'];
    protected $table = 'policy';

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!empty($model->code)){
                dispatch(new SendPolicyCode($model->user_name,$model->user_phone,$model->code,$model->type));
            }
        });
    }

}