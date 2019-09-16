<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Books;
use Faker\Generator as Faker;

$factory->define(Books::class, function (Faker $faker) {
    return [
        'title' => $faker->text($faker->numberBetween(5, 20)),
        'author' => $faker->name,
        'year' => $faker->numberBetween(1450, 2019),
        'quantity' => $faker->numberBetween(1, 10)
    ];
});
