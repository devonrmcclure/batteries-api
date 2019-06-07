<?php

namespace App\Http\Controllers\Api;

use App\Location;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\LocationCollection;
use App\Http\Resources\Location as LocationResource;

class LocationController extends ApiController
{
	// same as /id one heh
	public function index()
	{
		LocationResource::withoutWrapping();
		$location = QueryBuilder::for(Location::class)
			->allowedIncludes([
				'sales', 'staff', 'part-orders', 'repair-orders',
				'customers', 'daily-sales', 'monthly-sales', 'yearly-sales', 'on-hand-quantity'
			])
			->where('id', '=', auth()->user()->id)
			->first();

		return new LocationResource($location);
	}

	public function show(int $id)
	{
		LocationResource::withoutWrapping();
		$location = QueryBuilder::for(Location::class)
			->allowedIncludes([
				'sales', 'staff', 'part-orders', 'repair-orders',
				'customers', 'daily-sales', 'monthly-sales', 'yearly-sales', 'on-hand-quantity'
			])
			->where('id', '=', auth()->user()->id)
			->findOrFail($id);

		return new LocationResource($location);
	}
}
