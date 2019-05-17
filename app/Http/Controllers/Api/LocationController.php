<?php

namespace App\Http\Controllers\Api;

use App\Location;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\LocationCollection;
use App\Http\Resources\Location as LocationResource;

class LocationController extends ApiController
{
	public function index() {
		$locations = QueryBuilder::for(Location::class)
			->allowedIncludes(['sales', 'staff', 'part-orders', 'repair-orders', 
								'customers', 'daily-sales', 'monthly-sales', 'yearly-sales', 'on-hand-quantity'])
			->where('id', '=', auth()->user()->id)
			->get();

		return new LocationCollection($locations);
	}

	public function show(int $id) {
		$location = QueryBuilder::for(Location::class)
			->allowedIncludes(['sales', 'staff', 'part-orders', 'repair-orders', 
								'customers', 'daily-sales', 'monthly-sales', 'yearly-sales', 'on-hand-quantity'])
			->where('id', '=', auth()->user()->id)
			->findOrFail($id);

		return new LocationResource($location);
	}
}
