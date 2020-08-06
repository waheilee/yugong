<?php
/**
 * Created by PhpStorm.
 * User: waheilee
 * Date: 2020/8/6
 * Time: 10:27 AM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\GoodsOrderModel
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
 * @property string|null $wechat_refund_data 微信退款成功信息
 * @property string|null $wechat_order_no 微信订单号
 * @property string|null $wechat_transaction_id 微信交易流水号
 * @property string|null $wechat_pay_info 微信支付附加信息
 * @property string|null $name 联系人
 * @property string|null $phone 联系电话
 * @property string $order_address 地址
 * @property int|null $order_type 订单类型
 * @property int $status 订单状态
 * @property int $refund_status 是否已退款
 * @property string $pay_time 支付时间
 * @property string|null $refund_time 退款时间
 * @property string|null $remark 订单备注
 * @property int $sale_code 消费码(4位)
 * @property string|null $lose_time 过期时间
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsOrderModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsOrderModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsOrderModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsOrderModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsOrderModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsOrderModel whereLoseTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsOrderModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsOrderModel whereOrderAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsOrderModel whereOrderNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsOrderModel whereOrderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsOrderModel wherePayMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsOrderModel wherePayOrderNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsOrderModel wherePayTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsOrderModel wherePayType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsOrderModel wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsOrderModel whereRefundStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsOrderModel whereRefundTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsOrderModel whereRefundTradeNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsOrderModel whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsOrderModel whereSaleCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsOrderModel whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsOrderModel whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsOrderModel whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsOrderModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsOrderModel whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsOrderModel whereWechatOrderNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsOrderModel whereWechatPayInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsOrderModel whereWechatRefundData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoodsOrderModel whereWechatTransactionId($value)
 * @mixin \Eloquent
 */
class GoodsOrderModel extends Model
{
    protected $table = 'goods_order';
}