<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * This class is meant for each location to log in to the POS and be the
 * tie-in point for location specific things. (Staff, sales, POs, ROs, etc).
 *
 * The actual user class is meant for Admin control of the API itself - adding,
 * deleting, updating products, categories, etc.
 */
class Location extends Authenticatable
{
	use HasApiTokens;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function staff()
	{
		return $this->hasMany('App\Staff');
	}

	public function customers()
	{
		return $this->hasMany('App\Customer');
	}
}
