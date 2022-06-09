<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class ProductTypeSeeder extends Seeder
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
                'name'=>'Điện Thoại',
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
        ];
        DB::table('product_types')->insert($arr);
    }
}
