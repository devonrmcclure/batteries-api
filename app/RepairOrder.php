<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RepairOrder extends Model
{
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function staff()
    {
        return $this->belongsTo('App\Staff');
    }

    // A RO can have multiple sales (deposit, remainder, refund, etc);
    public function sales()
    {
    	return $this->hasMany('App\RepairOrderSale');
    }

    public function location()
    {
        return $this->belongsTo('App\Location');
    }
}
