<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memorys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ram')->nullable();
            $table->integer('rom')->nullable();
            $table->integer('memory_available')->nullable();//bo nho kha dung
            $table->string('memory_stick',50)->nullable();//the nho
            $table->string('phone_book',50)->nullable();//danh ba
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
        Schema::dropIfExists('memorys');
    }
}
