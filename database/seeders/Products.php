<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Products extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr=[
            [
                'account_id'=>'1',
                'product_type_id'=>'1',
                'provided_id'=>'1',
                'images'=>'',
                'name'=>'Điện thoại Samsung Galaxy S22 Ultra 5G 128GB',
                'describe'=>'',
                'product_code'=>Str::random(10),
                'amount'=>'1',
                'price'=>'50000',
                'tax'=>'0',
                'sold'=>'50',
                'so_sao'=>'5',
                'created_at'=>Carbon::now(),
            ],
            [
                'account_id'=>'1',
                'product_type_id'=>'1',
                'provided_id'=>'1',
                'images'=>'',
                'name'=>'Điện thoại Samsung Galaxy A13 6GB',
                'describe'=>'',
                'product_code'=>Str::random(10),
                'amount'=>'1',
                'price'=>'50000',
                'tax'=>'0',
                'sold'=>'50',
                'so_sao'=>'5',
                'created_at'=>Carbon::now(),
            ],
            [
                'account_id'=>'1',
                'product_type_id'=>'3',
                'provided_id'=>'1',
                'images'=>'',
                'name'=>'Máy tính bảng Samsung Galaxy Tab S8 ',
                'describe'=>'',
                'product_code'=>Str::random(10),
                'amount'=>'1',
                'price'=>'50000',
                'tax'=>'0',
                'sold'=>'50',
                'so_sao'=>'5',
                'created_at'=>Carbon::now(),
            ],
            [
                'account_id'=>'1',
                'product_type_id'=>'2',
                'provided_id'=>'2',
                'images'=>'',
                'name'=>'Máy tính bảng iPad Pro M1 12.9 inch WiFi Cellular 128GB (2021)',
                'describe'=>'',
                'product_code'=>Str::random(10),
                'amount'=>'1',
                'price'=>'50000',
                'tax'=>'0',
                'sold'=>'50',
                'so_sao'=>'5',
                'created_at'=>Carbon::now(),
            ],
            [
                'account_id'=>'1',
                'product_type_id'=>'3',
                'provided_id'=>'2',
                'images'=>'',
                'name'=>'Laptop MacBook Pro 14 M1 Max 2021 10-core CPU/32GB/512GB/24-core GPU (Z15G)',
                'describe'=>'',
                'product_code'=>Str::random(10),
                'amount'=>'1',
                'price'=>'50000',
                'tax'=>'0',
                'sold'=>'50',
                'so_sao'=>'5',
                'created_at'=>Carbon::now(),
            ],
        ];
        DB::table('products')->insert($arr);
    }
}
