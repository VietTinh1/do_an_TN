<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRearCamerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rear_cameras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('main_rear_camera')->nullable();//camera chính
            $table->integer('main_secondary_1')->nullable();//camera phụ
            $table->integer('main_secondary_2')->nullable();
            $table->string('flash_light',5)->nullable();//den flash
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
        Schema::dropIfExists('rear_cameras');
    }
}
