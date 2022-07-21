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
            $table->integer('user_id');
            $table->integer('product_type_id');
            $table->string('name_product',100)->unique()->nullable();
            $table->string('trademark',100)->nullable();//tên hãng
            $table->string('product_code',20)->unique()->nullable();
            $table->bigInteger('amount')->default(0)->unsigned();
            $table->decimal('price',30,3)->unsigned();
            $table->float('tax')->default(0);//thuế
            $table->string('unit')->default("VNĐ");
            $table->integer('time_warranty')->nullable();//tg bao hanh
            $table->integer('sale')->default(0);//khuyen mai
            $table->string('screen_technology',150)->nullable();//cong nghe màn hình
            $table->string('screen_resolution',150)->nullable();//độ phân giải màn hình
            $table->string('screen_width',150)->nullable();//chieu rong man hinh
            $table->string('screen_maximum_brightness',150)->nullable();//do sang toi da man hinh
            $table->string('touch_screen_glass',150)->nullable();//mat kinh cam ung man hinh
            $table->string('front_screen_resolution',150)->nullable();
            $table->string('rear_screen_resolution',150)->nullable();
            $table->string('flash_light',150)->nullable();//đèn
            $table->string('operating_system',150)->nullable();//he dieu hanh
            $table->string('CPU',150)->nullable();//chip cpu
            $table->string('speed_cpu',150)->nullable();
            $table->string('GPU',150)->nullable();//chip do hoa
            $table->integer('ram')->nullable();
            $table->integer('rom')->nullable();
            $table->integer('available_memory')->nullable();//bộ nhớ khả dụng
            $table->string('memory_stick',150)->nullable();//the nho
            $table->string('mobile_network',150)->nullable();//mang di dong
            $table->string('sim',150)->nullable();
            $table->string('phonebook',150)->nullable();//danh ba
            $table->string('charging_port',150)->nullable();//cong sac
            $table->string('headphone',150)->nullable();//tai nghe
            $table->string('connection_orther',150)->nullable();//ket noi khac
            $table->string('battery_capacity',150)->nullable();//dung luong pin
            $table->string('pin_type',150)->nullable();//loai pin
            $table->string('maximum_battery_charging_support',150)->nullable();//hỗ trợ sạc pin tối đa
            $table->string('charger_included',150)->nullable();//sac kem theo may
            $table->string('battery_technology',150)->nullable();//cong nghe pin
            $table->string('water_and_dust_resistant',150)->nullable();//khang nuoc, bui
            $table->string('radio',150)->nullable();
            $table->string('design',150)->nullable();//thiet ke
            $table->string('material',150)->nullable();//chat lieu
            $table->string('size_volume',150)->nullable();//kich thuoc, khoi luong
            $table->string('date_created',150)->nullable();//ngay ra mat
            $table->string('status')->default("Đang hoạt động");//Chưa hoạt động// Dừng hoạt động
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
