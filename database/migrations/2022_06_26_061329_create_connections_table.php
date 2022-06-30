<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mobile_network',50)->nullable();//mang di dong
            $table->string('sim',50)->nullable();//sim
            $table->string('charging_port',50)->nullable();//cong sac
            $table->string('head_phone',50)->nullable();//tai nghe
            $table->string('connection_orther',50)->nullable();//
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
        Schema::dropIfExists('connections');
    }
}
