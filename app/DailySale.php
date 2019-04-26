<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailySale extends Model
{
    public function location()
    {
        return $this->belongsTo('App\Location');
    }
}
