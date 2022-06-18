<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provideds', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('tax_code');
            $table->string('name',100);
            $table->string('email',100);
            $table->string('phone',10);
            $table->string('address',200);
            $table->string('notes');
            $table->string('status',25)->default("Đang hoạt động");// Dừng hoạt động
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
        Schema::dropIfExists('provideds');
    }
}
