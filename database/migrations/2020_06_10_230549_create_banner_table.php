<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_banner', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable()->comment('轮播图标题');
            $table->string('url')->nullable()->comment('图片地址');
            $table->integer('type')->nullable()->comment('banner图类型');
            $table->integer('status')->nullable()->comment('状态');
            $table->string('content')->nullable()->comment('内容：文章id、课程id、链接');
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
        Schema::dropIfExists('banner');
    }
}
