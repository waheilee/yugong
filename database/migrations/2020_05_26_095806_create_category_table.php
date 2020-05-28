<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->tinyInteger('parent_id')->default(0)->comment('分类父级ID');
            $table->tinyInteger('type')->nullable()->comment('分类所属类别');
            $table->integer('order')->default(0)->comment('排序');
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
        Schema::dropIfExists('category');
    }
}
