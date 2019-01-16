<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['cors']], function () {
	Route::post('/login', 'Api\AuthController@login');
});


Route::group(['middleware' => ['auth:api']], function () {
	Route::post('/logout', 'Api\AuthController@logout');

	// TODO: POST/PUT/PATCH/DEL for admin section editing
	Route::apiResource('locations', 'Api\LocationController');

	// TODO: POST/PUT/PATCH/DEL for admin section editing
	Route::apiResource('categories', 'Api\CategoryController');

	// TODO: POST/PUT/PATCH/DEL for admin section editing
	Route::apiResource('products', 'Api\ProductController');
});