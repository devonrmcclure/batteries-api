<?php

use Faker\Generator as Faker;

$factory->define(App\Customer::class, function (Faker $faker) {
	return [
		'name' => $faker->name,
		'phone' => $faker->isbn10,
		'address' => $faker->address,
		'city' => $faker->city,
		'province' => $faker->name,
		'country' => $faker->country,
		'email' => $faker->email,
		'location_id' => rand(1, 10) > 5 ? 1 : 2
	];
});
