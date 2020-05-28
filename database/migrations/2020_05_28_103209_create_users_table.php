<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('姓名');
            $table->string('phone')->nullable()->comment('联系电话')->unique();
            $table->string('password');
            $table->string('avatar')->nullable()->default('')->comment('头像');//头像
            $table->string('openid')->nullable()->comment('微信openid');
            $table->string('nickname')->nullable()->comment('微信名称');
            $table->tinyInteger('status')->default(0)->comment('是否冻结');//(是否冻结 。1为冻结，0为正常);
            $table->tinyInteger('level')->default(0)->comment('等级（星级）');//等级（星级），用户等级
            $table->text('remember_token')->nullable();
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
        Schema::dropIfExists('users');
    }
}
