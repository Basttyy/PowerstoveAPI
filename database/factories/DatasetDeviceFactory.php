<?php

use Faker\Generator as Faker;

$factory->define(App\DatasetDevice::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        // TODO: Add addtribute as needed
    ];
});
