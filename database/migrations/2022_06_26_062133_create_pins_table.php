<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('memory_pin',50)->nullable();//dung luong pin
            $table->string('pin_type',50)->nullable();
            $table->string('support_pin_max',50)->nullable();//ho tro pin toi da
            $table->string('charger',50)->nullable();//cu sac
            $table->string('technology_pin',50)->nullable();//cong nghe pin
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
        Schema::dropIfExists('pins');
    }
}
