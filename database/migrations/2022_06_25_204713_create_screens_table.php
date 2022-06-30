<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScreensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('screen_technology',50)->nullable();//cong nghe man hinh
            $table->string('resolution',50)->nullable();//do phan giai
            $table->string('width',50)->nullable();//do rong
            $table->integer('maximum_brightness')->nullable();//do sang toi da
            $table->string('unit',4)->default("nits");//don vi
            $table->string('touch_glass',50)->nullable();//mat kinh cam ung
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
        Schema::dropIfExists('screens');
    }
}
