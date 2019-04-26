<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	public function location()
	{
		return $this->belongsTo('App\Location');
	}

	public function part_orders()
	{
		return $this->hasMany('App\PartOrder');
	}

	public function repair_orders()
	{
		return $this->hasMany('App\RepairOrder');
	}

	public function sales() {
		return $this->hasMany('App\Sale');
	}
}
