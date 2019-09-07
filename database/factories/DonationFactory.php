<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Donation;
use Faker\Generator as Faker;

$factory->define(Donation::class, function (Faker $faker) {
    return [
        'donationType' => $faker->randomElement(['one-off', 'recurring']),
        'emailAddress' => $faker->email,
        'fullName' => $faker->firstName . ' ' . $faker->lastName,
        'paymentType' => $faker->randomElement(['card', 'paypal']),
        'donationAmount' => $faker->randomFloat(2, 1, 10000),
        'giftaid' => $faker->randomElement([true, false]),
    ];
});
