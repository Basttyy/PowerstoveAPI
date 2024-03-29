<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
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
        'avatar' => $faker->imageUrl(50, 50, 'people')
    ];
});
