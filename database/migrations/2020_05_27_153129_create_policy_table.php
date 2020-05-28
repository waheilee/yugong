<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolicyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policy', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_name',15)->nullable()->comment('姓名');
            $table->string('user_phone',15)->nullable()->comment('电话');
            $table->string('user_card_id',30)->nullable()->comment('身份证号');
            $table->string('code')->nullable()->comment('激活码');
            $table->integer('is_active')->default(0)->comment('是否激活.0为未激活，1为激活');
            $table->string('number')->nullable()->comment('保单号');
            $table->date('begin_time')->nullable()->comment('有效期起始时间');
            $table->date('end_time')->nullable()->comment('有效期结束时间');
            $table->integer('type')->nullable()->comment('险种');
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
        Schema::dropIfExists('policy');
    }
}
