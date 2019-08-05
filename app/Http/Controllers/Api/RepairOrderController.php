<?php

namespace App\Http\Controllers\Api;

use Validator;
use Carbon\Carbon;
use App\RepairOrder;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\RepairOrderCollection;
use App\Http\Resources\RepairOrder as RepairOrderResource;

class RepairOrderController extends ApiController
{
    public function index()
    {
        $repairOrders = QueryBuilder::for(RepairOrder::class)
            ->allowedIncludes(['location', 'sales', 'staff', 'customer'])
            ->where('location_id', '=', auth()->user()->id)
            ->get();

        if (count($repairOrders) == 0) {
            return response()->json(['message' => 'not found'], JsonResponse::HTTP_NOT_FOUND);
        }

		return new RepairOrderCollection($repairOrders);
    }

    

    public function store(Request $request)
    {
        $request->request->add(['location_id' => auth()->user()->id]);

        $validator = Validator::make($request->all(), [
            'order_number' => 'required|integer',
            'is_warranty' => 'required|boolean',
            'warranty_type' => 'string',
            'call_if_over' => 'integer',
            'referred_by' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'type' => 'string',
            'date_code' => 'string',
            'condition' => 'required|string',
            'accessories' => 'required|string',
            'customer_problem' => 'required|min:5',
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

		$repairOrder = RepairOrder::create($validator->validated(), ['location_id', auth()->user()->id]);

		return response()->json(new RepairOrderResource($repairOrder), 201);
    }

    public function show($id)
    {
        RepairOrderResource::withoutWrapping();

        $repairOrder = QueryBuilder::for(RepairOrder::class)
            ->allowedIncludes(['location', 'sales', 'staff', 'customer'])
            ->where('location_id', '=', auth()->user()->id)
			->findOrFail($id);

		return new RepairOrderResource($repairOrder);
    }

    public function update(Request $request, RepairOrder $repairOrder)
    {
        if ($repairOrder->location_id !== auth()->user()->id)
		{
			return response()->json(['message' => 'You are not authorized to edit this item.'], 401);
		}

        $validator = Validator::make($request->all(), [
            'order_number' => 'integer',
            'is_warranty' => 'boolean',
            'warranty_type' => 'string',
            'call_if_over' => 'integer',
            'referred_by' => 'string',
            'brand' => 'string',
            'model' => 'string',
            'type' => 'string',
            'date_code' => 'string',
            'condition' => 'string',
            'accessories' => 'string',
            'customer_problem' => 'min:5',
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

		$repairOrder->update($validator->validated());

		return response()->json(new RepairOrderResource($repairOrder), 200);
    }

    // VOID a repair order (doesn't delete from DB)
    public function destroy(RepairOrder $repairOrder)
    {
        if ($repairOrder->location_id !== auth()->user()->id)
		{
			return response()->json(['message' => 'You are not authorized to edit this item.'], 401);
		}

        $repairOrder->voided_at = Carbon::Now();
        $repairOrder->save();

        return response()->json(['message' => 'Repair Order voided.'], 200);
    }

    public function outstanding()
    {
        $repairOrders = QueryBuilder::for(RepairOrder::class)
            ->allowedIncludes(['location', 'sales', 'staff', 'customer'])
            ->where('location_id', '=', auth()->user()->id)
			->where('from_ho', '=', null)
            ->orWhere('from_ho', null)
            ->oldest()
			->get();

		return new RepairOrderCollection($repairOrders);
    }
}
