<?php
Route::post('/login', 'Api\AuthController@login');


Route::group(['middleware' => ['auth:api']], function () {
	Route::post('/logout', 'Api\AuthController@logout');

	Route::apiResource('locations', 'Api\LocationController')->only([
		'index', 'show'
	]);

	Route::apiResource('categories', 'Api\CategoryController')->only([
		'index', 'show'
	]);

	Route::apiResource('products', 'Api\ProductController')->only([
		'index', 'show'
	]);

	Route::apiResource('staff', 'Api\StaffController')->only([
		'index', 'show', 'update'
	]);

	Route::apiResource('customers', 'Api\CustomerController')->only([
		'index', 'show', 'store', 'update'
	]);
});