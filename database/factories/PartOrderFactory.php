<?php

use Faker\Generator as Faker;

$factory->define(App\PartOrder::class, function (Faker $faker) {
    return [
        'order_number' => random_int(300000, 400000),
		'referred_by' => $faker->name,
        'brand' => $faker->name,
        'model' => $faker->name,
        'staff_id' => 1,
        'customer_id' => 1
    ];
});
