<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperatingSystemCpusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operating_system_cpus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('operating_system_name',50)->nullable();//he dieu hanh
            $table->string('chip_cpus',50)->nullable();//ten cpu
            $table->string('speed_cpu',50)->nullable();//toc do cpu
            $table->string('speed_gpu',50)->nullable();//toc do gpu
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
        Schema::dropIfExists('cpus');
    }
}
