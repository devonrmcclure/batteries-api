<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
		'name' => $faker->name,
		'image' => str_random(5) . '.jpg',
		'parent_id' => rand(1, 10) > 8 ? factory('App\Category')->make() : null
    ];
});
