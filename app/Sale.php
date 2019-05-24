<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $guarded = ['products'];

    public function staff()
    {
        return $this->belongsTo('App\Staff');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    public function partOrder()
    {
        return $this->belongsTo('App\PartOrder');
    }

    public function repairOrder()
    {
        return $this->belongsTo('App\RepairOrder');
    }

    public function paymentMethod()
    {
        return $this->hasOne('App\PaymentMethod');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product')->using('App\ProductSale')
                ->withPivot([
                    'sku',
                    'price',
                    'description',
                    'quantity',
                    'description',
                    'pst',
                    'gst',
                    'total',
                    'comment',
                    'sale_type'
                ]);
    }
}
