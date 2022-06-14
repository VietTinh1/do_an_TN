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
            $table->integer('account_id');
            $table->string('name_customer',100);
            $table->string('email_customer',100);
            $table->integer('phone');
            $table->string('address_customer',100);
            $table->string('message')->nullable();
            $table->double('total');
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
