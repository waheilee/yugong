<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSerUserCertificateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ser_user_certificate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ser_user_id')->comment('服务人id');
            $table->bigInteger('certificate_id')->comment('证书id');
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
        Schema::dropIfExists('ser_user_certificate');
    }
}
