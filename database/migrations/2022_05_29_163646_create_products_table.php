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
            $table->string('name',100)->unique()->nullable();
            $table->string('trademark',100)->nullable();//tên hãng
            $table->string('product_code',20)->unique()->nullable();
            $table->integer('amount')->default(0)->unsigned();
            $table->decimal('price')->unsigned();
            $table->string('unit')->default("VNĐ");
            $table->integer('time_warranty')->nullable();//tg bao hanh
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
