<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_plan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->comment('计划课程名称');
            $table->string('student',100)->nullable()->comment('规划学习人群或计划公司员工');
            $table->string('time',50)->nullable()->comment('课时总时长');
            $table->integer('num_people')->nullable()->comment('学习人数');
            $table->string('grade')->nullable()->comment('课程评分');
            $table->text('content')->nullable()->comment('课程介绍');
            $table->json('lesson')->nullable()->comment('课程计划下所有课程');
            $table->string('url')->nullable()->comment('计划课程封面');
            $table->integer('status')->comment('计划课程状态');
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
        Schema::dropIfExists('exam_plan');
    }
}
