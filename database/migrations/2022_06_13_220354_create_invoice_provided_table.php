<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceProvidedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_provides', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('provided_id');
            $table->integer('account_id');
            $table->double('total');
            $table->string('status')->default("Đang xử lí");// Đã xử lí // Đã hủy
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
        Schema::dropIfExists('invoice_provides');
    }
}
