<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'description' => $faker->text,
        'stock' => 12,
        'wholesale_unit_value' => '24.000',
        'unit_value' => '47.000'
    ];
});
