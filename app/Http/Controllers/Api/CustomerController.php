<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
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
			->allowedIncludes(['location', 'sales', 'part-orders', 'repair-orders'])
			->allowedFilters(['type', 'phone'])
			->where('location_id', '=', auth()->user()->id)
			->jsonPaginate();

		return new CustomerCollection($customer);
	}

	public function show($search)
	{
		CustomerResource::withoutWrapping();

		$customer = QueryBuilder::for(Customer::class)
			->allowedIncludes(['location', 'sales', 'part-orders', 'repair-orders'])
			->allowedFilters(['type'])
			->where('phone', $search)
			->orWhere('id', $search)
			->where('location_id', '=', auth()->user()->id)
			->firstOrFail();

		return new CustomerResource($customer);
	}

	public function store(Request $request)
	{
		$request->request->add(['location_id' => auth()->user()->id]);

		$validator = Validator::make($request->all(), [
			'name' => 'required|string',
			'phone' => 'required|string',
			'address' => 'string',
			'city' => 'string',
			'province' => 'string',
			'country' => 'string',
			'postal_code' => 'string',
			'email' => 'string',
			'location_id' => 'required',
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

		$customer = Customer::create($validator->validated());

		return response()->json(new CustomerResource($customer), 201);
	}

	public function update(Request $request, Customer $customer)
	{
		if ($customer->location_id !== auth()->user()->id) {
			return response()->json(['message' => 'You are not authorized to edit this item.'], 401);
		}

		$validator = Validator::make($request->all(), [
			'name' => 'string',
			'phone' => 'string',
			'address' => 'string',
			'city' => 'string',
			'province' => 'string',
			'country' => 'string',
			'postal_code' => 'string',
			'email' => 'string',
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

		$customer->update($validator->validated());

		return response()->json(new CustomerResource($customer), 200);
	}
}
