<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRebackSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reback_skills', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');//申請者學校username
            $table->string('co_name')->nullable();
            $table->unsignedInteger('class_num');
            $table->unsignedInteger('people_num');
            $table->tinyInteger('situation');//情況 1送審 2同意 3.退回
            $table->unsignedInteger('skill_id');
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
        Schema::dropIfExists('reback_skills');
    }
}
