<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->nullable();
            $table->string('image_url',100)->nullable();
            $table->string('fullname',100)->nullable();
            $table->string('sex',3)->nullable();
            $table->date('birthday')->nullable();
            $table->bigInteger('citizen_ID')->unique();//Căn cước công dân
            $table->string('address',100)->nullable();
            $table->integer('phone')->unsigned();
            $table->string('email',100)->unique()->nullable();
            $table->string('permission',10)->nullable();
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
        Schema::dropIfExists('users');
    }
}
