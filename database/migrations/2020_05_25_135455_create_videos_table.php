<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->comment('视频标题');
            $table->string('url')->comment('视频地址');
            $table->bigInteger('views')->default(1)->comment('浏览量');
            $table->integer('category_id')->comment('所属类别');
            $table->string('tag')->comment('标签');
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
        Schema::dropIfExists('videos');
    }
}
