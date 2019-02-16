<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\Customer as CustomerResource;

class CustomerController extends ApiController
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$customer = QueryBuilder::for(Customer::class)
			->allowedIncludes(['location', 'sales', 'partOrders', 'repairOrders'])
			->jsonPaginate();

		return new CustomerCollection($customer);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Customer  $customer
	 * @return \Illuminate\Http\Response
	 */
	public function show(int $id)
	{
		CustomerResource::withoutWrapping();

		$customer = QueryBuilder::for(Customer::class)
			->allowedIncludes(['location', 'sales', 'partOrders', 'repairOrders'])
			// ->allowedFields(['name', 'phone', 'address', 'city', 'province', 'country', 'email', 'location_id', 'created_at', 'updated_at'])
			->findOrFail($id);

		return new CustomerResource($customer);
	}

	public function store()
	{
		throw new \Error('Not yet implemented');
	}

	public function update()
	{
		throw new \Error('Not yet implemented');
	}
}
