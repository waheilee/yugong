<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_room', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->comment('考场标题');
            $table->integer('category_id')->comment('所属培训类别ID');
            $table->string('exam_book')->comment('考试大纲');
            $table->integer('exam_status')->comment('考场状态，1为关闭，0为开启');
            $table->string('intro')->comment('考场简介');
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
        Schema::dropIfExists('exam_room');
    }
}
