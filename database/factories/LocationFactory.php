<?php

use Faker\Generator as Faker;

$factory->define(\App\Location::class, function (Faker $faker) {
	return [
		'name' => $faker->name,
		'user_id' => 1,
		'email' => str_random(10) . '@gmail.com',
		'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
		'remember_token' => str_random(10),
	];
});
