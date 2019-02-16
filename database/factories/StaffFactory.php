<?php

use Faker\Generator as Faker;

$factory->define(App\Staff::class, function (Faker $faker) {
	return [
		'name' => $faker->name,
		'initials' => str_random(2),
		'location_id' => rand(1, 10) > 5 ? 1 : 2
	];
});
