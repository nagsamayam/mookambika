<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Faq::class, function (Faker $faker) {
    return [
        'title' => $faker->text(70),
        'content' => $faker->paragraph(5),
        'meta_description' => $faker->sentence,
        'created_at' => $faker->dateTimeBetween($startDate = '-4 months', $endDate = '-3 months'),
        'published_at' => $faker->date(),
    ];
});
