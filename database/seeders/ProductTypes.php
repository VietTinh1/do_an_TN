<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
class ProductTypes extends Seeder
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
                'name'=>'Dien Thoai',
                'created_at'=>Carbon::now(),
            ],
            [
                'name'=>'Tablet',
                'created_at'=>Carbon::now(),
            ],
            [
                'name'=>'Laptop',
                'created_at'=>Carbon::now(),
            ],
            [
                'name'=>'Dien Thoai cu',
                'created_at'=>Carbon::now(),
            ],
            [
                'name'=>'Phu Kien',
                'created_at'=>Carbon::now(),
            ],
        ];
        DB::table('payment_types')->insert($arr);
    }
}
