<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateSystemActionLogTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('system_action_log', function (Blueprint $table) {
      $table->increments('id');
      $table->string("uid")->comment("用户id");
      $table->string("username")->comment("姓名");
      $table->string("type", "50")->comment("操作类型");
      $table->string("model", "50")->comment("模型类型");
      $table->string("ip", "50")->nullable()->comment("操作者ip");
      $table->string("browser", 150)->nullable()->comment("浏览器");
      $table->string("system", 50)->nullable()->comment("操作系统");
      $table->string("url", 150)->nullable()->comment('url');
      $table->string("content")->comment("操作描述");

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
    Schema::drop('system_action_log');
  }
}
