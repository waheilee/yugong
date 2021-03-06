<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\Models\ServiceUserModel
 *
 * @property int $id
 * @property string $name 姓名
 * @property string|null $openid 微信openid
 * @property string|null $nickname 微信名称
 * @property string|null $phone 联系电话
 * @property string|null $id_card 身份证号
 * @property string|null $avatar 头像
 * @property int|null $parent_id 师傅ID
 * @property int $status 是否冻结
 * @property string $bank 银行
 * @property string $bank_branch 所属支行
 * @property string $bank_num 银行卡号
 * @property int $level 手艺人等级（星级）
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceUserModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceUserModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceUserModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceUserModel whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceUserModel whereBank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceUserModel whereBankBranch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceUserModel whereBankNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceUserModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceUserModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceUserModel whereIdCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceUserModel whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceUserModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceUserModel whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceUserModel whereOpenid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceUserModel whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceUserModel wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceUserModel wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceUserModel whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceUserModel whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceUserModel whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $province 省份
 * @property string|null $city 市
 * @property string|null $county 县
 * @property string|null $address 详细地址
 * @property string|null $lng 经度
 * @property string|null $lat 纬度
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceUserModel whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceUserModel whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceUserModel whereCounty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceUserModel whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceUserModel whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceUserModel whereProvince($value)
 */
class ServiceUserModel extends Authenticatable implements JWTSubject
{
    protected $table = 'service_users';

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}