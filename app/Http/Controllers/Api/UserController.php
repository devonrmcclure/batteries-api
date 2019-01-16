<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Resources\UserCollection as UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp;

class UserController extends ApiController
{
    public function index() {
		return new UserResource(User::all());
	}
}
