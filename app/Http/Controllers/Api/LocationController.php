<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Location;
use App\Http\Resources\Location as LocationResource;
use App\Http\Resources\LocationCollection;
use Spatie\QueryBuilder\QueryBuilder;

class LocationController extends ApiController
{
	public function index(Request $request) {
		$locations = QueryBuilder::for(Location::class)
			->allowedIncludes(['sales', 'staff'])
			->get();

		return new LocationCollection($locations);
	}

	public function show(int $id) {
		$location = QueryBuilder::for(Location::class)
			->allowedIncludes(['sales', 'staff'])
			->findOrFail($id);

		return new LocationResource($location);
	}
}
