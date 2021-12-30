<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_datas', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('school_code');//學校代碼
            $table->string('school_name');//學校
            $table->string('kind');//教職員
            $table->string('title')->nullable();//職稱
            $table->string('edu_key');
            $table->string('uid');
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
        Schema::dropIfExists('school_datas');
    }
}
