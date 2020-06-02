<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('p_id')->nullable()->comment('父级ID');
            $table->string('title')->comment('培训分类名称');
            $table->string('image')->nullable()->comment('缩略图');
            $table->text('content')->nullable()->comment('培训考试内容介绍');
            $table->text('intro')->nullable()->comment('培训考试简介');
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
        Schema::dropIfExists('training_category');
    }
}
