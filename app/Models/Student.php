<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Student
 *
 * @property int $id
 * @property string $card_a 身份证正面照片链接
 * @property string $card_b 身份证方面照片链接
 * @property string $card_num 身份证号码
 * @property string $name 工人姓名
 * @property int $age 工人年龄
 * @property int $sex 工人性别
 * @property string $phone 工人电话
 * @property string|null $email 邮箱
 * @property string $province 省份
 * @property string $city 市
 * @property string $county 县、区
 * @property int $tec 技能
 * @property int $work_age 工作年龄
 * @property string|null $tec_text 其他技能
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $merchant_id 所属商户id
 * @property string|null $qrcode 工人信息二维码
 * @property string|null $avatar 工人头像
 * @property string|null $channel 工人所需渠道
 * @property string|null $password 密码
 * @property int|null $is_active 判断首次登录
 * @property string|null $policy_order_num 关联保单订单号
 * @property string|null $remember_token
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereCardA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereCardB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereCardNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereChannel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereCounty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student wherePolicyOrderNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereQrcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereTec($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereTecText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Student whereWorkAge($value)
 * @mixin \Eloquent
 */
class Student extends Model
{

    protected $table = 'worker';

//    public function getExtraAttribute($extra)
//    {
//        return array_values(json_decode($extra, true) ?: []);
//    }
//
//    public function setExtraAttribute($extra)
//    {
//        $this->attributes['extra'] = json_encode(array_values($extra));
//    }
}