<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Resources\UserCollection as UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp;

class UserController extends Controller
{
    public function index() {
		return new UserResource(User::all());
	}
}
