<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'title'       => $faker->text(30),
        'description' => $faker->paragraph(2),
        'date'        => $faker->dateTime(),
        'location'    => $faker->address,
        'created_at'  => $faker->dateTimeBetween($startDate = '-4 months', $endDate = '-3 months'),
        'date'        => $faker->dateTimeBetween($startDate = '-2 months', $endDate = 'now'),
        'slug'        => $faker->slug,
    ];
});
