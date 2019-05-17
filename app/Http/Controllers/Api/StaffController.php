<?php

namespace App\Http\Controllers\Api;

use App\Staff;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\StaffCollection;
use App\Http\Resources\Staff as StaffResource;

class StaffController extends ApiController
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$staff = QueryBuilder::for(Staff::class)
			->allowedIncludes(['location', 'sales', 'partOrders', 'repairOrders'])
			->where('location_id', '=', auth()->user()->id)
			->jsonPaginate();

		return new StaffCollection($staff);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Staff  $staff
	 * @return \Illuminate\Http\Response
	 */
	public function show(int $id)
	{
		StaffResource::withoutWrapping();

		$staff = QueryBuilder::for(Staff::class)
			->allowedIncludes(['location', 'sales', 'partOrders', 'repairOrders'])
			->where('location_id', '=', auth()->user()->id)
			->findOrFail($id);

		return new StaffResource($staff);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Staff  $staff
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Staff $staff)
	{
        //
	}
}
