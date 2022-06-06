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
                'supplier_id'=>'1',
                'images'=>'',
                'name'=>'Điện thoại Samsung Galaxy S22 Ultra 5G 128GB',
                'product_code'=>Str::random(10),
                'amount'=>'133',
                'price'=>'50000',
                'tax'=>'0',
                'sold'=>'50',
                'so_sao'=>'5',
                'created_at'=>Carbon::now(),
            ],
            [
                'account_id'=>'1',
                'product_type_id'=>'2',
                'supplier_id'=>'2',
                'images'=>'',
                'name'=>'Máy tính bảng Samsung Galaxy Tab S8 ',
                'product_code'=>Str::random(10),
                'amount'=>'133',
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
