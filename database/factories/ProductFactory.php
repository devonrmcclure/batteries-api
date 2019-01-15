<?php

use Faker\Generator as Faker;

$factory->define(\App\Product::class, function (Faker $faker) {
    return [
		'sku' => random_int(1, 100),
		'description' => str_random(100),
		'unit_price' => random_int(100, 10000),
		'unit_sale_price' => 0,
		'pst' => rand(1, 10) > 5 ? true : false,
		'gst' => rand(1, 10) > 5 ? true : false,
		'image' => str_random(5) . '.jpg',
		'brand' => $faker->name,
		'manufacturer' => $faker->name,
		'model_number' => str_random(5),
		'order_number' => str_random(5),
		'last_purchase_vendor' => 0,
		'current_purchase_vendor' => 0
    ];
});
