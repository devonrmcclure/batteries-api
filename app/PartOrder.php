<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartOrder extends Model
{
    protected $gaurded = [];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function staff()
    {
        return $this->belongsTo('App\Staff');
    }

    // A PO can have multiple sales (deposit, remainder, refund, etc);
    public function sales()
    {
    	return $this->hasMany('App\Sale');
    }

    public function location()
    {
        return $this->belongsTo('App\Location');
    }
}
