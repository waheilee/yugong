<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id')->comment('所属类别');
            $table->string('title')->comment('课程标题');
            $table->string('image')->nullable()->comment('缩略图');
            $table->string('intro')->nullable()->comment('简介');
            $table->text('content')->nullable()->comment('课程大纲');
            $table->integer('sort')->nullable()->comment('排序');
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
        Schema::dropIfExists('lesson');
    }
}
