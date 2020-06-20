<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SerUserCertificateModel
 *
 * @property int $id
 * @property int $ser_user_id 服务人id
 * @property int $certificate_id 证书id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SerUserCertificateModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SerUserCertificateModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SerUserCertificateModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SerUserCertificateModel whereCertificateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SerUserCertificateModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SerUserCertificateModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SerUserCertificateModel whereSerUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SerUserCertificateModel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SerUserCertificateModel extends Model
{

    protected $table = 'ser_user_certificate';
}