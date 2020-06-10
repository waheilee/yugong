<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamPaperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_paper', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('lesson_id')->comment('试卷所属考场');
            $table->string('title')->comment('试卷标题');
            $table->integer('timeout')->comment('考试所需时间');
            $table->integer('pass')->comment('及格线');
            $table->json('question')->comment('试题');
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
        Schema::dropIfExists('exam_paper');
    }
}
