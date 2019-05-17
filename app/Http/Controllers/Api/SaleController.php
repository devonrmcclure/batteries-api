<?php

namespace App\Http\Controllers\Api;

use App\Sale;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\SaleCollection;
use App\Http\Resources\Sale as SaleResource;


class SaleController extends ApiController
{

    public function index()
    {
        $sales = QueryBuilder::for(Sale::class)
			->allowedIncludes(['staff', 'category', 'customer', 'location', 'part_order', 'repair_order', 'payment_method', 'products'])
			->jsonPaginate();

		return new SaleCollection($sales);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    // Only allow changing of payment method incase of misclick. 
    public function update(Request $request, $id)
    {
        //
    }
}
