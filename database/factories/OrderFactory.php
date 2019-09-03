<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(order::class, function (Faker $faker) {
    return [
        'address' => $faker->address,
        'city' => $faker->city,
        'receiver_name' => $faker->name,
        'email' => $faker->email,
        'status' => 'created',
        'guide_number' => $faker->uuid,
        'total' => 52.00,
    ];
});
