<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchmakingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matchmakings', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('situation');//情況 1登記參訪 2同意參訪 3.退回參訪
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('visit_id')->nullable();//參訪課程(公司、達人)
            $table->unsignedInteger('course_id')->nullable();//職探課程
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
        Schema::dropIfExists('matchmakings');
    }
}
