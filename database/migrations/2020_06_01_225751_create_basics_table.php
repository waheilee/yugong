<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->comment('考场标题');
            $table->integer('train_category_id')->comment('所属培训类别ID');
            $table->string('basic_book')->comment('考试大纲');
            $table->integer('basic_closed')->comment('考场状态，1为关闭，0为开启');
            $table->string('basic_describe')->comment('考场简介');
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
        Schema::dropIfExists('basics');
    }
}
