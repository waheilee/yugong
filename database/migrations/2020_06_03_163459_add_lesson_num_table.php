<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLessonNumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lesson', function (Blueprint $table) {
            $table->integer('degree')->comment('难度系数：初级，中级，高级');
            $table->string('views')->default(1)->comment('观看学习人数');
            $table->integer('is_free')->default(0)->comment('是否免费');
            $table->integer('price')->nullable()->comment('价格');
            $table->integer('discounts')->nullable()->comment('优惠价格');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
