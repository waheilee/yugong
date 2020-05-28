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
            $table->tinyInteger('pay_money')->default(0)->comment('支付金额');//支付金额
            $table->string('order')->default('')->comment('订单号');//订单号
            $table->date('order_time')->nullable()->comment('上门服务时间');
            $table->string('order_address')->default('')->comment('上门服务地址');
            $table->string('area')->default('')->comment('服务面积');
            $table->string('estimate')->nullable()->comment('预估价格');
            $table->integer('order_type')->nullable()->comment('订单类型');//订单类型
            $table->integer('status')->default(0)->comment('订单状态');//状态
            $table->timestamp('pay_time')->comment('支付时间');//支付时间
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
