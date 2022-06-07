<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PaymentTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pay = [
            [
                'card_code' => Str::random(10),
                'card_type' => 'ATM Noi Dia',
                'created_at' => Carbon::now(),
            ],
            [
                'card_code' => Str::random(10),
                'card_type' => 'ATM Quoc Te',
                'created_at' => Carbon::now(),
            ],
            [
                'card_code' => Str::random(10),
                'card_type' => 'MoMo',
                'created_at' => Carbon::now(),
            ],
            [
                'card_code' => Str::random(10),
                'card_type' => 'Tien Mat',
                'created_at' => Carbon::now(),
            ],
        ];
        DB::table('payment_types')->insert($pay);
    }
}
