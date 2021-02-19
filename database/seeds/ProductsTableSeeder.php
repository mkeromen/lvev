<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'id' => 1,
                'unit_id' => 1,
                'name' => 'Amandes crues'
            ],
            [
                'id' => 2,
                'unit_id' => 1,
                'name' => 'Amandes pralinées à l\'érable'
            ],
            [
                'id' => 3,
                'unit_id' => 1,
                'name' => 'Graines de citrouille'
            ],
            [
                'id' => 4,
                'unit_id' => 1,
                'name' => 'Noisettes crues'
            ],
            [
                'id' => 5,
                'unit_id' => 1,
                'name' => 'Noix du Brésil'
            ],
            [
                'id' => 6,
                'unit_id' => 1,
                'name' => 'Pacanes en demies'
            ],
            [
                'id' => 7,
                'unit_id' => 1,
                'name' => 'Pistaches avec écales rôties salées'
            ],
            [
                'id' => 8,
                'unit_id' => 2,
                'name' => 'Liquide à vaiselle - bionature'
            ],
            [
                'id' => 9,
                'unit_id' => 2,
                'name' => 'Détergent lessive ultra concentré - bionature'
            ],
            [
                'id' => 10,
                'unit_id' => 2,
                'name' => 'Nettoyant à plancher - planette'
            ]
        ]);
    }
}
