<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSerAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ser_address', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ser_id')->comment('服务人员id');
            $table->string('province')->nullable()->comment('省份');
            $table->string('city')->nullable()->comment('市');
            $table->string('county')->nullable()->comment('县');
            $table->string('address')->nullable()->comment('详细地址');
            $table->string('phone')->nullable()->comment('联系电话');
            $table->string('name')->nullable()->comment('收件人姓名');
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
        Schema::dropIfExists('ser_address');
    }
}
