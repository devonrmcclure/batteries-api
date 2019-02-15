<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    public function location()
    {
        return $this->belongsTo('App\Location');
    }
}
