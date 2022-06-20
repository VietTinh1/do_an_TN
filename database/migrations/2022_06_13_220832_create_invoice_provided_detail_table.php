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
            $table->integer('product_id')->nullable();//áp dụng sp có sẵn
            $table->integer('product_type_id')->nullable();
            $table->string('image_url',100);
            $table->string('name',100)->nullable();//áp dụng chưa có sp
            $table->string('trademark',100)->nullable();//tên hãng
            $table->string('product_code')->nullable();
            $table->integer('amount');
            $table->double('import_price');
            $table->integer('time_warranty');//tg bao hanh
            $table->float('tax')->default(0);//thuế
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
