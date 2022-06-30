<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuration', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('image_detail_id')->nullable();
            $table->integer('screen_id')->nullable();
            $table->integer('front_id')->nullable();//camera truoc
            $table->integer('rear_camera_id')->nullable();//camera sau
            $table->integer('operating_system_cpu_id')->nullable();//he dieu hanh,cpu
            $table->integer('memory_id')->nullable();//bo nho
            $table->integer('connection_id')->nullable();//ket noi
            $table->integer('pin_id')->nullable();//pin sac
            $table->integer('utilities_id')->nullable();//tien ich
            $table->integer('information_id')->nullable();//thong tin chung
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
        Schema::dropIfExists('configuration');
    }
}
