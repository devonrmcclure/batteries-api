<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\RepairOrder;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\RepairOrderCollection;
use App\Http\Resources\RepairOrder as RepairOrderResource;

class RepairOrderController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $repairOrders = QueryBuilder::for(RepairOrder::class)
			->allowedIncludes(['location', 'sales', 'staff', 'customer'])
			->jsonPaginate();

		return new RepairOrderCollection($repairOrders);
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

		$repairOrder = RepairOrder::create($validator->validated());

		return response()->json(new RepairOrderResource($repairOrder), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        RepairOrderResource::withoutWrapping();

        $repairOrder = QueryBuilder::for(RepairOrder::class)
			->allowedIncludes(['location', 'sales', 'staff', 'customer'])
			->findOrFail($id);

		return new RepairOrderResource($repairOrder);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RepairOrder $repairOrder)
    {
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

		$repairOrder->update($validator->validated());

		return response()->json(['message' => 'Repair Order updated.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    	// TODO: Implement so an employee can VOID a repair order (doesn't delete from DB)

    public function destroy($id)
    {
        throw new \Error('Not yet implemented');
    }
}
