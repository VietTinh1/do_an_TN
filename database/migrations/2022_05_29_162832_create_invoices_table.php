<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name_customer',100)->nullable();
            $table->string('email_customer',100)->nullable();
            $table->bigInteger('phone')->nullable();
            $table->string('address_customer',100)->nullable();
            $table->string('message')->nullable();
            $table->decimal('total',30,3)->nullable();
            $table->string('status',25)->default("Chờ xử lí");//Đang xử lí // Đã xử lí // Đã hủy
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
        Schema::dropIfExists('invoices');
    }
}
