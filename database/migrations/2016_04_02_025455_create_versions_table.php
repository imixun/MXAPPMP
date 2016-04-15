<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('versions', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->integer('app_id')->unsigned()->comment('应用ID');
            $table->tinyInteger('app_type')->unsigned()->comment('应用类型 1:android;2:IOS');
            $table->integer('index')->unsigned()->comment('真实版本号');
            $table->string('code', 50)->comment('版本号');
            $table->string('info')->comment('版本信息');
            $table->string('url')->comment('下载地址');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('versions');
    }
}
