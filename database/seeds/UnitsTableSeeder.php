<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('units')->insert([
            [
                'id' => 1,
                'symbol' => 'Kg'
            ],
            [
                'id' => 2,
                'symbol' => 'L'
            ],
            [
                'id' => 3,
                'symbol' => 'unité'
            ]
        ]);
    }
}
