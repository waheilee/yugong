<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SmsSendTab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms', function (Blueprint $table) {
            $table->uuid('uuid');
            $table->string('phone')->comment('手机号');//手机号
            $table->tinyInteger('type')->comment('类型1 c端验证,2后端验证,3普通短信');//类型1 c端验证,2后端验证,3普通短信
            $table->text('note')->comment('信息主体');//信息
            $table->tinyInteger('status')->comment('1未确认,2发送成功,3发送失败');//1未确认,2发送成功,3发送失败
            $table->dateTime('lose_time')->nullable()->comment('失效时间');//失效时间
            $table->string('code')->nullable()->comment('验证码');//验证码
            $table->softDeletes();
            $table->timestamps();
            $table->primary('uuid');
            $table->index('phone');
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
