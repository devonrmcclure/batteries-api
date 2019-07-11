<?php

namespace App\Http\Controllers\Api;

use App\Sale;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\SaleCollection;
use App\Http\Resources\Sale as SaleResource;


class SaleController extends ApiController
{
    public function index()
    {
        $sales = QueryBuilder::for(Sale::class)
            ->allowedIncludes([
                'staff', 'category', 'customer', 'location', 'part_order',
                'repair_order', 'payment_method', 'products'
            ])
            ->where('location_id', '=', auth()->user()->id)
            ->latest()
            ->jsonPaginate();

        return new SaleCollection($sales);
    }

    public function store(Request $request)
    {
        $request->request->add(['location_id' => auth()->user()->id]);

        $validator = Validator::make($request->all(), [
            'invoice_number' => 'required|integer',
            'subtotal' => 'required|integer',
            'pst' => 'required|integer',
            'gst' => 'required|integer',
            'total' => 'required|integer',
            'items_sold' => 'required|integer',
            'invoice_comment' => 'required|string',
            'printed' => 'required|boolean',
            'staff_id' => 'required|integer|exists:staff,id',
            'customer_id' => 'required|integer|exists:customers,id',
            'payment_method' => 'required|integer|exists:payment_methods,id',
            'sale_type' => 'required|string',
            'products' => 'required|array'
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

        $sale = Sale::create($validator->validated() + ['location_id' => auth()->user()->id]);

        // do the sales_products mapping.
        // TODO: Make a ProductSaleController to handle this. 

        $products = ProductSaleController::store($sale, $request->input('products'), auth()->user()->id);

        if ($products->getStatusCode() !== 200) {
            $sale->delete(); // delete sale.

            return response()->json(json_decode($products->content()));
        }

        return response()->json(['message' => 'Sale completed!'], 200);
    }

    public function show($id)
    {
        SaleResource::withoutWrapping();

        $sale = QueryBuilder::for(Sale::class)
            ->allowedIncludes([
                'location', 'staff', 'customer', 'payment-method',
                'part-order', 'repair-order', 'products'
            ])
            // ->allowedFields(['name', 'phone', 'address', 'city', 'province', 'country', 'email', 'location_id', 'created_at', 'updated_at'])
            ->where('location_id', '=', auth()->user()->id)
            ->with('products')
            ->findOrFail($id);

        return new SaleResource($sale);
    }

    // Only allow changing of payment method incase of misclick. 
    public function update(Request $request, $id)
    {
        throw new \Error('Not yet implemented', 501);
    }

    public function latest()
    {
        $sales = QueryBuilder::for(Sale::class)
            ->allowedIncludes(['staff', 'category', 'customer', 'location', 'part_order', 'repair_order', 'payment_method', 'products'])
            ->where('location_id', '=', auth()->user()->id)
            ->latest()
            ->limit(5)
            ->get();

        if (count($sales) == 0) {
            return response()->json(['message' => 'not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        return new SaleCollection($sales);
    }
}
