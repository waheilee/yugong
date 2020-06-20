<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_certificate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->comment('证书名称');
            $table->string('url')->nullable()->comment('证书图片路径');
            $table->string('require')->comment('换取证书要求通过的的考试');
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
        Schema::dropIfExists('certificate');
    }
}
