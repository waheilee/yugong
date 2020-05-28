<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('姓名');
            $table->string('openid')->nullable()->comment('微信openid');
            $table->string('nickname')->nullable()->comment('微信名称');
            $table->string('phone')->nullable()->comment('联系电话')->unique();
            $table->string('password');
            $table->string('id_card')->nullable()->comment('身份证号');
            $table->string('avatar')->nullable()->default('')->comment('头像');//头像
            $table->bigInteger('parent_id')->nullable()->comment('师傅ID');
            $table->tinyInteger('status')->default(0)->comment('是否冻结');//(是否冻结 。1为冻结，0为正常);
            $table->string('bank',50)->default('')->comment('银行');//银行
            $table->string('bank_branch')->default('')->comment('所属支行');//所属支行
            $table->string('bank_num')->default('')->comment('银行卡号');//银行卡号
            $table->tinyInteger('level')->default(0)->comment('手艺人等级（星级）');//等级（星级），用户等级
            $table->text('remember_token')->nullable();
//            $table->rememberToken();
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
