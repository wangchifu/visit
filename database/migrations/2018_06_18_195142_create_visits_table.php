<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('visit_careers')->nullable();//visit_careers
            $table->string('visit_name');//課程/科系名稱
            $table->text('about');//課程/科系簡介
            $table->text('graduate')->nullable();//畢業生出路介紹
            $table->unsignedInteger('views');//觀看次數
            $table->unsignedInteger('visits');//參訪次數
            $table->text('tabs');//搜尋標籤
            $table->unsignedInteger('user_id');
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
        Schema::dropIfExists('visits');
    }
}
