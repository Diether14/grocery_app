<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Item::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'description' => $faker->sentence(),
        'price'         => $faker->randomNumber(),
        'status'        => $faker->word()
    ];
});
