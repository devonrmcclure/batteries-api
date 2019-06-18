<?php

namespace App\Http\Controllers\Api;

use App\Sale;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class ProductSaleController extends Controller
{
    // Store the pivot info from SaleController.
    public static function store(Sale $sale, $products, $locationID)
    {
        $valid = [];
        foreach ($products as $product) {
            $validator = Validator::make($product, [
                'sku' => 'required|string',
                'price' => 'required|integer',
                'description' => 'required|string',
                'quantity' => 'required|integer',
                'extended' => 'required|integer',
                'pst' => 'required|integer',
                'gst' => 'required|integer',
                'total' => 'required|integer',
                'comment' => 'alpha',
                'product_id' => 'required|integer'
            ]);

            if ($validator->fails()) {
                $messages = [];
                $errors = $validator->errors();

                foreach ($errors->all() as $message) {
                    array_push($messages, $message);
                }
                $json = [
                    'message' => $messages,
                    'status' => JsonResponse::HTTP_UNPROCESSABLE_ENTITY
                ];

                return response()->json($json, JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }

            array_push($valid, $validator->validated());
        }

        $sale->products()->attach($valid, ['location_id' => $locationID, 'sale_id' => $sale->id]);

        return response()->json(['message' => 'okay'], JsonResponse::HTTP_OK);
    }
}
