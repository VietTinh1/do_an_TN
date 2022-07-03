<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id=Account::insertGetId(
            [
                'username' => 'ThanhTrieu',
                'password' => Hash::make('0123456789'),
                'token' => Str::random(64),
                'created_at' => Carbon::now(),
            ]
        );
        $user=[
            [
             'account_id'=>$id,
             'image_url'=>'',
             'fullname'=>'Nguyen Thanh Trieu',
             'sex' =>'nam',
             'birthday'=>'2001/11/25',
             'citizen_ID'=>'074201000025',
             'address'=>'Ho Chi Minh',
             'phone'=>'0365931327',
             'email'=>'trieularavel@gmail.com',
             'permission'=>'admin',
             'created_at' => Carbon::now(),
            ],
         ];
         DB::table('users')->insert($user);
    }
}
