<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class Suppliers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sup=[
            [
                'tax_code'=>"123456789",
                'name'=>'Cong ty TNHH Mot Thanh Vien',
                'phone'=>'03020501321',
                'address'=>'HoChiMinhCity',
                'created_at'=>Carbon::now(),
            ],
            [
                
                'tax_code'=>"234567891",
                'name'=>'Cong ty TNHH Mot Thanh Vien',
                'phone'=>'03020501322',
                'address'=>'HoChiMinhCity',
                'created_at'=>Carbon::now(),
            ],
        ];
        DB::table('suppliers')->insert($sup);
    }
}
