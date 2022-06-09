<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=[
            [
             'account_id'=>'1',
             'image_url'=>'',
             'fullname'=>'Nguyen Thanh Trieu',
             'birthday'=>'2001/11/25',
             'address'=>'Ho Chi Minh',
             'phone'=>'0365931327',
             'email'=>'trieularavel@gmail.com',
             'permission'=>'admin',
             'created_at'=>Carbon::now(),
            ],
            [
             'account_id'=>'2',
             'image_url'=>'',
             'fullname'=>'Le Viet Tinh',
             'birthday'=>'2001/11/25',
             'address'=>'Ho Chi Minh',
             'phone'=>'0365931327',
             'email'=>'trieularavel@gmail.com',
             'permission'=>'admin',
             'created_at'=>Carbon::now(),
             ],
         ];
         DB::table('users')->insert($user);
    }
}
