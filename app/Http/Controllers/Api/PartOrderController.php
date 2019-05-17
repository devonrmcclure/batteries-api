<?php

namespace App\Http\Controllers\Api;

use Validator;
use Carbon\Carbon;
use App\PartOrder;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\PartOrderCollection;
use App\Http\Resources\PartOrder as PartOrderResource;

class PartOrderController extends ApiController
{

    public function index()
    {
        $partOrders = QueryBuilder::for(PartOrder::class)
			->allowedIncludes(['location', 'sales', 'staff', 'customer'])
			->where('location_id', '=', auth()->user()->id)
			->jsonPaginate();

		return new PartOrderCollection($partOrders);
    }

    public function store(Request $request)
    {
		$request->request->add(['location_id' => auth()->user()->id]);
		
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
			'location_id' => 'required',
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

		$partOrder = PartOrder::create($validator->validated(), ['location_id', auth()->user()->id]);

		return response()->json(new PartOrderResource($partOrder), 201);
    }

    public function show(int $id)
    {
        PartOrderResource::withoutWrapping();

        $partOrder = QueryBuilder::for(PartOrder::class)
			->allowedIncludes(['location', 'sales', 'staff', 'customer'])
			->where('location_id', '=', auth()->user()->id)
			->findOrFail($id);

		return new PartOrderResource($partOrder);
    }

    public function update(Request $request, PartOrder $partOrder)
    {
		if ($partOrder->location_id !== auth()->user()->id)
		{
			return response()->json(['message' => 'You are not authorized to edit this item.'], 401);
		}

        $validator = Validator::make($request->all(), [
            'order_number' => 'integer',
            'referred_by' => 'string',
            'brand' => 'string',
            'model' => 'string',
            'item' => 'string',
            'part_number' => 'string',
            'part_description' => 'string',
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

		return response()->json(new PartOrderResource($partOrder), 200);
	}
	
	// VOID a part order (doesn't delete from DB)
	public function destroy(PartOrder $partOrder)
	{
		if ($partOrder->location_id !== auth()->user()->id)
		{
			return response()->json(['message' => 'You are not authorized to edit this item.'], 401);
		}

		$partOrder->voided_at = Carbon::Now();
		$partOrder->save();
		
		return response()->json(['message' => 'Part Order voided.'], 200);
	}
}