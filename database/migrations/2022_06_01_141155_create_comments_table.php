<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->string('name_customer')->nullable();
            $table->string('email_customer')->nullable();
            $table->bigInteger('phone_customer')->nullable();
            $table->string('message_customer')->nullable();
            $table->string('status')->default("Đang hoạt động");//Đã hủy
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
        Schema::dropIfExists('comments');
    }
}
