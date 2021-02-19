<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_store', function (Blueprint $table) {
            $table->bigInteger('product_id')->unsigned()->index(); 
            $table->bigInteger('store_id')->unsigned()->index();
            $table->float('product_price');
        });
        
        Schema::table('products_store', function($table) {
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('store_id')->references('id')->on('stores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_store');
    }
}
