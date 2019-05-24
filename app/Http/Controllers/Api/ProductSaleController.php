<?php

namespace App\Http\Controllers\Api;

use App\Sale;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductSaleController extends Controller
{
    // Store the pivot info from SaleController.
    public static function store(Sale $sale, $products, $locationID) 
    {
        $valid = [];
        foreach($products as $product)
        {
            $validator = Validator::make($product, [
                'sku' => 'required|integer',
                'price' => 'required|integer',
                'description' => 'required|string',
                'quantity' => 'required|integer',
                'extended' => 'required|integer',
                'pst' => 'required|integer',
                'gst' => 'required|integer',
                'total' => 'required|integer',
                'comment' => 'required|alpha',
                'sale_type' => 'required|string',
                'product_id' => 'required|integer'
            ]);
            
            if($validator->fails())
            {
                return false;
            }

            array_push($valid, $validator->validated());
       }
    
       $sale->products()->attach($valid, ['location_id' => $locationID, 'sale_id' => $sale->id]);

       return true;
    }
}
