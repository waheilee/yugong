<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('lesson_id')->comment('被评论课程ID');
            $table->bigInteger('user_id')->comment('评论人id');
            $table->string('avatar')->nullable()->comment('头像');
            $table->string('name')->nullable()->comment('评论人');
            $table->text('content')->nullable()->comment('评论内容');
            $table->bigInteger('like')->nullable()->comment('点赞数');
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
        Schema::dropIfExists('comment');
    }
}
