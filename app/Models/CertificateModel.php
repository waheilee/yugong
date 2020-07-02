<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\CertificateModel
 *
 * @property int $id
 * @property string $title 证书名称
 * @property string|null $url 证书图片路径
 * @property string $require 换取证书要求通过的的考试
 * @property string|null $icon_url 底图
 * @property string $pass_num 获取此证书人数
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CertificateModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CertificateModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CertificateModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CertificateModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CertificateModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CertificateModel whereRequire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CertificateModel whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CertificateModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CertificateModel whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CertificateModel whereIconUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CertificateModel wherePassNum($value)
 * @mixin \Eloquent
 */
class CertificateModel extends Model
{

    protected $table = 'exam_certificate';

}