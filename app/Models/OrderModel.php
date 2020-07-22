<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderModel
 *
 * @property int $id
 * @property int $user_id 订单所属消费者ID
 * @property int|null $service_id 订单所属服务人ID
 * @property string $title 订单标题
 * @property int $pay_type 支付类型（微信，支付宝，银行卡）
 * @property int $pay_money 支付金额
 * @property string $order_num 订单流水号
 * @property string|null $pay_order_num 支付平台返回的单号
 * @property string|null $refund_trade_no 退款单号
 * @property string|null $order_time 上门服务时间
 * @property string|null $name 联系人
 * @property string|null $phone 联系电话
 * @property string $order_address 上门服务地址
 * @property string $area 服务面积
 * @property string|null $estimate 预估价格
 * @property int|null $order_type 订单类型
 * @property int $status 订单状态
 * @property int $refund_status 是否已退款
 * @property string $pay_time 支付时间
 * @property string|null $refund_time 退款时间
 * @property string|null $remark 订单备注
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderModel whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderModel whereEstimate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderModel whereOrderAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderModel whereOrderNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderModel whereOrderTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderModel whereOrderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderModel wherePayMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderModel wherePayOrderNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderModel wherePayTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderModel wherePayType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderModel wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderModel whereRefundStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderModel whereRefundTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderModel whereRefundTradeNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderModel whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderModel whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderModel whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderModel whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderModel whereUserId($value)
 * @mixin \Eloquent
 */
class OrderModel extends Model
{

    protected $table = 'order';
}