<?php

use Illuminate\Support\Facades\Schema;
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
            $table->increments('id')->unique();
            $table->string('username');
            $table->string('password');
            $table->string('login_type');//local是本機，gsuite是縣府來的
            $table->string('name');
            $table->tinyInteger('group_id')->nullable();//1.管理階層，2.國中小學校，4.職探中心，8.高中職，16.公司企業，32.職場達人
            $table->unsignedInteger('township')->nullable();//鄉鎮
            $table->string('address')->nullable();
            $table->string('telephone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('line_id')->nullable();
            $table->string('website')->nullable();
            $table->tinyInteger('disable')->nullable();//null啟用，1停用，2申請
            $table->rememberToken();
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
