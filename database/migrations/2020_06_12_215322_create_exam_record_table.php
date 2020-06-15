<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_record', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ser_user_id')->comment('手艺人id');
            $table->integer('paper_id')->comment('试卷id');
            $table->json('total')->comment('答题对错情况');
            $table->float('score')->comment('考试得分');
            $table->string('pass',20)->comment('是否通过');
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
        Schema::dropIfExists('exam_record');
    }
}
