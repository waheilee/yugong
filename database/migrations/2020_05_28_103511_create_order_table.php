<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->comment('订单所属消费者ID');
            $table->bigInteger('service_id')->nullable()->comment('订单所属服务人ID');
            $table->string('title')->default('')->comment('订单标题');//订单标题
            $table->tinyInteger('pay_type')->default(0)->comment('支付类型（微信，支付宝，银行卡）');//
            $table->bigInteger('pay_money')->default(0)->comment('支付金额');//支付金额
            $table->string('order_num')->unique()->comment('订单流水号');
            $table->string('pay_order_num')->nullable()->comment('支付平台返回的单号');
            $table->string('refund_trade_no')->nullable()->comment('退款单号');
            $table->date('order_time')->nullable()->comment('上门服务时间');
            $table->string('name',30)->nullable()->comment('联系人');
            $table->string('phone',15)->nullable()->comment('联系电话');
            $table->string('order_address')->default(null)->comment('上门服务地址');
            $table->string('area')->default('')->comment('服务面积');
            $table->string('estimate')->nullable()->comment('预估价格');
            $table->integer('order_type')->nullable()->comment('订单类型');//订单类型
            $table->integer('status')->default(0)->comment('订单状态');//状态
            $table->integer('refund_status')->default(0)->comment('是否已退款');
            $table->dateTime('pay_time')->comment('支付时间');//支付时间
            $table->dateTime('refund_time')->nullable()->comment('退款时间');
            $table->text('remark')->nullable()->comment('订单备注');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
