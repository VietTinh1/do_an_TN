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
            $table->string('image_url_front',100)->nullable();
            $table->string('image_url_backside',100)->nullable();
            $table->string('name',100)->nullable();//áp dụng chưa có sp
            $table->string('trademark',100)->nullable();//tên hãng
            $table->string('product_code',20)->nullable();
            $table->bigInteger('amount')->nullable();
            $table->decimal('import_price',30,3)->nullable();
            $table->integer('time_warranty')->nullable();//tg bao hanh
            $table->float('tax')->default(0);//thuế
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
