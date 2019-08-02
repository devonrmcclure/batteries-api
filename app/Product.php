<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	public function category() {
		return $this->belongsTo('App\Category');
	}

	public function sales()
	{
		return $this->belongsToMany('App\Sale')->using('App\ProductSale')->withPivot([
			'sku',
			'price',
			'description',
			'quantity',
			'description',
			'extended',
			'pst',
			'gst',
			'total',
			'comment',
		])->orderByDesc('created_at');
	}
}
