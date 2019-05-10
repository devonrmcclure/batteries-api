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

	Route::apiResource('products', 'Api\ProductController', )->only([
		'index', 'show'
	])->parameters([
		'products' => 'sku'  //@show will use products/{sku}
	]);

	Route::apiResource('staff', 'Api\StaffController')->only([
		'index', 'show', 'update'
	]);

	Route::apiResource('customers', 'Api\CustomerController')->only([
		'index', 'show', 'store', 'update'
	]);

	Route::apiResource('payment-methods', 'Api\PaymentMethodController')->only([
		'index', 'show'
	]);

	Route::apiResource('part-orders', 'Api\PartOrderController')->only([
		'index', 'show', 'store', 'update'
	]);

	Route::apiResource('repair-orders', 'Api\RepairOrderController')->only([
		'index', 'show', 'store', 'update'
	]);
});