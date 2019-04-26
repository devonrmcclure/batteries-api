<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    public function sale()
    {
        return $this->belongsTo('App\Sale');
    }
}
