<?php

use Faker\Generator as Faker;

$factory->define(\App\Location::class, function (Faker $faker) {
	return [
		'name' => $faker->name,
		'user_id' => 1,
		'email' => str_random(10) . '@gmail.com',
		'phone' => $faker->phoneNumber,
		'address' => $faker->address,
		'password' => bcrypt('secret'), // secret
		'remember_token' => str_random(10),
	];
});
