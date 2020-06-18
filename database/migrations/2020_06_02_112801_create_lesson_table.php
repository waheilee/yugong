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
        Schema::create('exam_lesson', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id')->comment('所属类别');
            $table->string('title')->comment('课程标题');
            $table->string('url')->nullable()->comment('缩略图');
            $table->string('intro')->nullable()->comment('简介');
            $table->text('content')->nullable()->comment('课程大纲');
            $table->integer('sort')->nullable()->comment('排序');
            $table->integer('degree')->comment('难度系数：初级，中级，高级');
            $table->string('views')->default(1)->comment('观看学习人数');
            $table->integer('is_free')->default(0)->comment('是否免费');
            $table->integer('price')->nullable()->comment('价格');
            $table->integer('discounts')->nullable()->comment('优惠价格');
            $table->string('tags')->nullable()->comment('标签');
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
