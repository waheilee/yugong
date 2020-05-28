<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\Models\UserModel
 *
 * @property int $id
 * @property string $name 姓名
 * @property string|null $phone 联系电话
 * @property string $password
 * @property string|null $avatar 头像
 * @property string|null $openid 微信openid
 * @property string|null $nickname 微信名称
 * @property int $status 是否冻结
 * @property int $level 等级（星级）
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel whereOpenid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserModel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UserModel extends Authenticatable
{

    protected $table = 'users';
}