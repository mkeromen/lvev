<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsStoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products_store')->insert([
            [
                'product_id' => 1,
                'store_id' => 1,
                'product_price' => 20.30
            ],
            [
                'product_id' => 1,
                'store_id' => 2,
                'product_price' => 21
            ],
            [
                'product_id' => 1,
                'store_id' => 3,
                'product_price' => 22.50
            ],
            [
                'product_id' => 1,
                'store_id' => 4,
                'product_price' => 22.70
            ],
            [
                'product_id' => 1,
                'store_id' => 5,
                'product_price' => 23
            ],
            [
                'product_id' => 1,
                'store_id' => 6,
                'product_price' => 26.50
            ],
            [
                'product_id' => 2,
                'store_id' => 1,
                'product_price' => 19.60
            ],
            [
                'product_id' => 2,
                'store_id' => 3,
                'product_price' => 20.20
            ],
            [
                'product_id' => 2,
                'store_id' => 4,
                'product_price' => 20.19
            ],
            [
                'product_id' => 2,
                'store_id' => 6,
                'product_price' => 18.70
            ],
            [
                'product_id' => 2,
                'store_id' => 7,
                'product_price' => 19.30
            ],
            [
                'product_id' => 2,
                'store_id' => 8,
                'product_price' => 19.40
            ],
            [
                'product_id' => 8,
                'store_id' => 6,
                'product_price' => 5
            ],
            [
                'product_id' => 8,
                'store_id' => 7,
                'product_price' => 5.20
            ],
            [
                'product_id' => 8,
                'store_id' => 8,
                'product_price' => 6
            ]
        ]);
    }
}
