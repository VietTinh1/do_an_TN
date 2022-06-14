<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceProvidedDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_provided_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_provided_id');
            $table->integer('product_id');
            $table->string('image_url',100);
            $table->integer('amount');
            $table->double('import_price');
            $table->string('describe')->default("Không");//mô tả
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
        Schema::dropIfExists('invoice_provided_details');
    }
}
