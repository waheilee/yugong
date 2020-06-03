<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeVideosTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_videos', function (Blueprint $table) {
            $table->integer('category_id')->nullable()->comment('所属类别')->change();
            $table->string('tag')->nullable()->comment('标签')->change();
            $table->integer('sort')->nullable()->comment('排序');
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
