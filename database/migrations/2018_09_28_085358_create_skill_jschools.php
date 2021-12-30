<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillJschools extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skill_jschools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('jschool_code');//自辦國中6碼代號
            $table->string('jschool_name');//自辦國中校名
            $table->tinyInteger('disable')->nullable();//1停用，null啟用
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
        Schema::dropIfExists('skill_jschools');
    }
}
