<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Location;
use App\Http\Resources\Location as LocationResource;

class LocationController extends ApiController
{
	public function index(Request $request) {
		$location = request()->user(); // I don't know how to change user() to location() to reflect the db properly...
		return new LocationResource($location);
	}
}
