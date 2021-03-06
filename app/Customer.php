<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	protected $guarded = [];

	public function location()
	{
		return $this->belongsTo('App\Location');
	}

	public function partOrders()
	{
		return $this->hasMany('App\PartOrder');
	}

	public function repairOrders()
	{
		return $this->hasMany('App\RepairOrder');
	}

	public function sales() {
		return $this->hasMany('App\Sale');
	}
}
