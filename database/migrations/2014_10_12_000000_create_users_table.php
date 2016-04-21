<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id')->comment('ID');
            $table->string('user_name',60)->comment('用户名');
            $table->string('name')->nullable()->comment('名字');
            $table->string('email')->unique()->comment('邮箱');
            $table->string('password', 60)->comment('密码');
            $table->rememberToken()->comment('web端记住登录');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('users')->insert([
            'user_name' => 'admin',
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
