<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Store;

class StoreController extends Controller
{
   
    public function getStoresByProductId(Request $request) 
    {
        try {
            return Product::where('id', '=', $request->product)
                ->with('unit')
                ->with(['stores' => function($q) {
                    $q->orderBy('pivot_product_price', 'ASC');
                }])->first();
        } catch(\Throwable $e) {
            return response([
                'message' => 'Product not found',
                'errors' => []
            ], 404);
        }
    }
    
    /**
     * @param Request $request
     * @return array
     */
    public function getStoresByName(Request $request)
    {
        try {
            return Store::limit(5)
            ->where('name', 'like', '%' . $request->search . '%')
            ->get();
        } catch(\Exception $e) {
            return [];
        }
    }
}
