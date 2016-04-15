<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patches', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->integer('version_id')->unsigned()->comment('版本ID');
            $table->string('url')->comment('下载地址');
            $table->string('md5')->comment('补丁包md5');
            $table->string('md5_rsa')->comment('补丁包md5值rsa加密base64转换');
            $table->string('info')->comment('补丁信息');
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
        Schema::drop('patches');
    }
}
