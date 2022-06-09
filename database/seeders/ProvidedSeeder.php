<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
class ProvidedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sup = [
            [
                'tax_code' => "123456789",
                'name' => 'SamSung',
                'email'=>'samsung@gmail.com',
                'phone' => '03020501321',
                'address' => 'HoChiMinhCity',
                'created_at' => Carbon::now(),
            ],
            [

                'tax_code' => "234567891",
                'name' => 'Apple',
                'email' =>'apple@gmail.com',
                'phone' => '03020501322',
                'address' => 'HoChiMinhCity',
                'created_at' => Carbon::now(),
            ],
        ];
        DB::table('provideds')->insert($sup);
    }
}
