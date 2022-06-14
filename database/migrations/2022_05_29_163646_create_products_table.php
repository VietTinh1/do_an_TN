<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id');
            $table->integer('product_type_id');
            $table->string('images',100);
            $table->string('name',100);
            $table->string('product_code');
            $table->integer('amount')->default(0)->unsigned();
            $table->decimal('price')->unsigned();
            $table->string('unit',20);
            $table->string('describe')->default("Không");//mô tả
            $table->integer('time_warranty');//tg bao hanh
            $table->integer('sale')->default(0);//khuyen mai
            $table->float('tax')->default(0);//thuế
            $table->integer('so_sao')->default(0);
            $table->string('status')->default("Đang hoạt động");// Dừng hoạt động
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
        Schema::dropIfExists('products');
    }
}
