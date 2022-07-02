<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $acc = [
            [
                'username' => 'ThanhTrieu',
                'password' => Hash::make('0123456789'),
                'token' => Str::random(64),
                'created_at' => Carbon::now(),
            ],
            [
                'username' => 'VietTinh',
                'password' => Hash::make('0123456789'),
                'token' => Str::random(64),
                'created_at' => Carbon::now(),
            ],
        ];
        DB::table('accounts')->insert($acc);
    }
}
