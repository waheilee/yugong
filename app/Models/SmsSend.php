<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\SmsSend
 *
 * @property string $uuid
 * @property string $phone 手机号
 * @property int $type 类型1 c端验证,2后端验证,3普通短信
 * @property string $note 信息主体
 * @property int $status 1未确认,2发送成功,3发送失败
 * @property string|null $lose_time 失效时间
 * @property string|null $code 验证码
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsSend newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsSend newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsSend query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsSend whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsSend whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsSend whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsSend whereLoseTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsSend whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsSend wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsSend whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsSend whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsSend whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsSend whereUuid($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SmsSend onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SmsSend withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SmsSend withoutTrashed()
 */
class SmsSend extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $table = 'sms';
    protected $dates = ['delete_at'];
}