<?php

namespace App\Http\Controllers\Api;

use App\PartOrder;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\PartOrderCollection;
use App\Http\Resources\PartOrder as PartOrderResource;

class PartOrderController extends ApiController
{
    /**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function index()
    {
        $partOrders = QueryBuilder::for(PartOrder::class)
			->allowedIncludes(['location', 'sales', 'staff', 'customer'])
			->jsonPaginate();

		return new PartOrderCollection($partOrders);
    }

    /**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_number' => 'required|integer',
            'referred_by' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'item' => 'required|string',
            'part_number' => 'required|string',
            'part_description' => 'required|string',
            'staff_id' => 'required|integer|exists:staff,id',
            'customer_id' => 'required|integer|exists:customers,id',
			'location_id' => 'required|integer|exists:locations,id',
			'to_ho' => 'date',
            'from_ho' => 'date',
            'picked_up' => 'date'
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

		$partOrder = PartOrder::create($validator->validated());

		return response()->json(new PartOrderResource($partOrder), 201);
    }

    /**
	 * Display the specified resource.
	 *
	 * @param  \App\PartOrder  $partOrder
	 * @return \Illuminate\Http\Response
	 */
    public function show(int $id)
    {
        PartOrderResource::withoutWrapping();

        $partOrder = QueryBuilder::for(PartOrder::class)
			->allowedIncludes(['location', 'sales', 'staff', 'customer'])
			->findOrFail($id);

		return new PartOrderResource($partOrder);
    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\PartOrder  $partOrder
	 * @return \Illuminate\Http\Response
	 */
    public function update(Request $request, PartOrder $partOrder)
    {
        $validator = Validator::make($request->all(), [
            'order_number' => 'integer',
            'referred_by' => 'string',
            'brand' => 'string',
            'model' => 'string',
            'item' => 'string',
            'part_number' => 'string',
            'part_description' => 'string',
            'staff_id' => 'integer|exists:staff,id',
            'customer_id' => 'integer|exists:customers,id',
			'location_id' => 'integer|exists:locations,id',
			'to_ho' => 'date',
            'from_ho' => 'date',
            'picked_up' => 'date'
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

		$partOrder->update($validator->validated());

		return response()->json(['message' => 'Part Order updated.'], 200);
	}
	
	// TODO: Implement so an employee can VOID a part order (doesn't delete from DB)
	public function destroy($id)
	{
		throw new \Error('Not yet implemented');
	}
}
