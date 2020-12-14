<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('transactions')->insert([
            [
                'user_id' => 1,
                'dateTime' => now()
            ],
            [
                'user_id' => 3,
                'dateTime' => now()
            ],
            [
                'user_id' => 1,
                'dateTime' => now()
            ]
        ]);
    }
}
