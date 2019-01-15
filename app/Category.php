<?php

namespace App;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	
    public function products() {
		return $this->hasMany('\App\Product');
	}

	public function parents() {
		return $this->hasMany(self::class, 'id', 'parent_id');
	}

	public function grandparents() {
		return $this->parents('parents')->with('grandparents');
	}

	public function children() {
		return $this->hasMany(self::class, 'parent_id');
	}

	public function grandchildren() {
		return $this->children('children')->with('grandchildren');
	}
}
