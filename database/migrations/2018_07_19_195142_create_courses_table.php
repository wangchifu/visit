<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('semester');//活動學期
            $table->string('start_date');//開始日
            $table->string('active_date');//活動時間
            $table->string('stop_date');//最後日
            $table->string('active_place');//活動地點
            $table->string('course_name');//課程
            $table->text('about');//課程簡介
            $table->string('tabs');//搜尋標籤
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('views');//觀看次數
            $table->unsignedInteger('visits');//參訪次數
            $table->tinyInteger('disable')->nullable();//1停用，null開放
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
        Schema::dropIfExists('courses');
    }
}
