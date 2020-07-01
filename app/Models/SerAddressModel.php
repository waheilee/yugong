<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SerAddressModel
 *
 * @property int $id
 * @property int $ser_id 服务人员id
 * @property string|null $province 省份
 * @property string|null $city 市
 * @property string|null $county 县
 * @property string|null $address 详细地址
 * @property string|null $phone 联系电话
 * @property string|null $name 收件人姓名
 * @property int $default 默认地址
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SerAddressModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SerAddressModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SerAddressModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SerAddressModel whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SerAddressModel whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SerAddressModel whereCounty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SerAddressModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SerAddressModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SerAddressModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SerAddressModel wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SerAddressModel whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SerAddressModel whereSerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SerAddressModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SerAddressModel whereDefault($value)
 * @mixin \Eloquent
 */
class SerAddressModel extends Model
{

    protected $table = 'ser_address';
}