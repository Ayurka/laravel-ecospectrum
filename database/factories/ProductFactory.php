<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Backend\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {

    return [
        'title' => $faker->realText($maxNbChars = 30, $indexSize = 2),
        'model' => $faker->postcode,
        'price' => $faker->numberBetween(1000, 5000),
        'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'quantity' => $faker->numberBetween(50, 500),
        'public' => 1
    ];
});
