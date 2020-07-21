<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSerUserAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_users', function (Blueprint $table) {
            $table->string('province')->nullable()->comment('省份');
            $table->string('city')->nullable()->comment('市');
            $table->string('county')->nullable()->comment('县');
            $table->string('address')->nullable()->comment('详细地址');
            $table->string('lng',50)->nullable()->comment('经度');
            $table->string('lat',50)->nullable()->comment('纬度');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
