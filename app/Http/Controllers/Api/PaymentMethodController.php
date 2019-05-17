<?php

namespace App\Http\Controllers\Api;

use App\PaymentMethod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\PaymentMethodCollection;
use App\Http\Resources\PaymentMethod as PaymentMethodResource;

class PaymentMethodController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentMethods = QueryBuilder::for(PaymentMethod::class)
            ->get();

		return new PaymentMethodCollection($paymentMethods);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        PaymentMethodResource::withoutWrapping();

		$paymentMethod = QueryBuilder::for(PaymentMethod::class)
			->allowedIncludes(['sale'])
			->findOrFail($id);

		return new PaymentMethodResource($paymentMethod);
    }
}
