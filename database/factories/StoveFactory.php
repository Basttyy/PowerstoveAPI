<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Stove;
use Faker\Generator as Faker;

$factory->define(Stove::class, function (Faker $faker) {
    return [
        'imei' => $faker->md5(),
        'paid' => $faker->boolean($ChanceOfGettingTrue = 50),
        'api_token' => $faker->md5()
    ];
});
