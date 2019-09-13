<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Agent;
use Faker\Generator as Faker;

$factory->define(Agent::class, function (Faker $faker) {
    static $password;
    $path = public_path().'\images\avatar\agent';
    return [
        'name' => $faker->name($gender = null),
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'credit_card' => '4242424242424242',
        'address' => $faker->streetAddress,
        'city' => $faker->city,
        'region' => $faker->state,
        'postal_code' => $faker->postcode,
        'country' => $faker->country,
        'mob_phone' => $faker->e164PhoneNumber,
        'activated' => rand(0, 1),
        'avatar' => $faker->imageUrl(200, 200, 'people')
    ];
});
