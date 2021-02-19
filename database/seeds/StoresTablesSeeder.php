<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stores')->insert([
            [
                'id' => 1,
                'name' => 'Vrac et bocaux',
                'url' => 'https://vracetbocaux.ca/en/'
            ],
            [
                'id' => 2,
                'name' => 'Vrac sur roues',
                'url' => 'https://www.vracsurroues.com'
            ],
            [
                'id' => 3,
                'name' => 'Loco - Villeray',
                'url' => 'https://www.epicerieloco.ca/'
            ],
            [
                'id' => 4,
                'name' => 'Loco - Verdun',
                'url' => 'https://www.epicerieloco.ca/'
            ],
            [
                'id' => 5,
                'name' => 'Mega vrac - Masson',
                'url' => 'https://megavrac.com/'
            ],
            [
                'id' => 6,
                'name' => 'Mega vrac - Ontario',
                'url' => 'https://megavrac.com/'
            ],
            [
                'id' => 7,
                'name' => 'Bocoboco',
                'url' => 'https://www.bocoboco.ca/'
            ],
            [
                'id' => 8,
                'name' => 'Frenco',
                'url' => 'http://www.frenco.ca/'
            ],
            [
                'id' => 9,
                'name' => 'Folies en vrac',
                'url' => 'https://www.facebook.com/Folieenvrac/'
            ]
        ]);
    }
}
