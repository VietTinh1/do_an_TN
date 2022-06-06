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
        $pay=[
            [
                'card_type'=>'ATM Noi Dia',
                'card_code'=>Str::random(10),
                'created_at'=>Carbon::now(),
            ],
            [
                'card_type'=>'ATM Quoc Te',
                'card_code'=>Str::random(10),
                'created_at'=>Carbon::now(),
            ],
            [
                'card_type'=>'MoMo',
                'card_code'=>Str::random(10),
                'created_at'=>Carbon::now(),
            ],
            [
                'card_type'=>'Tien Mat',
                'card_code'=>Str::random(10),
                'created_at'=>Carbon::now(),
            ],
        ];
        DB::table('payment_types')->insert($pay);
    }
}
