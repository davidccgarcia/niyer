<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'description' => $faker->text,
        'photo' => 'photos/wi57oGPEutvquPWRr67c8NlgjLS77BlcEYLqM97v.jpeg',
        'stock' => 12,
        'wholesale_unit_value' => '24.000',
        'price' => '47.000'
    ];
});
