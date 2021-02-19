<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Store;


class ProductController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function addProduct(Request $request)
    {
        $isIntOrString = function($attribute, $value, $fail) {
            if(!is_int($value) || is_int($value) && $value <= 0) {
                if(!is_string($value)) $fail($attribute . ' is invalid.');
            }
        };
        
        $request->validate([
            'product' => ['required', 'max:100', $isIntOrString],
            'store' => ['required', 'max:100', $isIntOrString],
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/'
        ]);
        
        try {
           
           $product = (is_int($request->product)) ? Product::find($request->product) : Product::create([
              'unit_id' => $request->unit_id,
              'name' => $request->product
            ]);

           if(is_int($request->store)) {
               $store = Store::find($request->store);
           } else {
               $store = new Store();
               $store->name = $request->store;
           }
           
           if(!$product->stores->contains($store->id)) {
              $product
                ->stores()
                ->save($store, ['product_price' => $request->price]);
           } else {
              $product
                ->stores()
                ->updateExistingPivot($store->id, ['product_price' => $request->price]);
           }
           
           return response([
               'message' => 'Product added.',
               'errors' => []
           ], 201);
           
        } catch(\Illuminate\Database\QueryException $e) {
            $code = $e->errorInfo[1];
            if($code == 1062) {
                return response([
                    'message' => 'Duplicate entry.',
                    'errors' => ['product' => ['duplicate.entry']]
                ], 400);
            }
        }
    }
     
    public function getProductUnits(Request $request)
    {}
    
     /**
      * @param Request $request
      * @return array
      */
    public function getProductsByName(Request $request)
    {
        try {
            return Product::limit(5)
                ->where('name', 'like', '%' . $request->search . '%')
                ->get();
        } catch(\Exception $e) {
            return [];
        }
    }
}
