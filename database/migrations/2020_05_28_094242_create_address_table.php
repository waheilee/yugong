<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->comment('所属用户ID');
            $table->bigInteger('service_id')->comment('所属服务人ID');
            $table->string('province')->nullable()->comment('省份');
            $table->string('city')->nullable()->comment('市');
            $table->string('county')->nullable()->comment('县');
            $table->string('address')->nullable()->comment('详细地址');
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
        Schema::dropIfExists('address');
    }
}
