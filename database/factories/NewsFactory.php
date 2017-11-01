<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\News::class, function (Faker $faker) {
    return [
        'title' => $faker->text(70),
        'summary' => $faker->paragraph,
        'content' => $faker->paragraph(5),
        'meta_description' => $faker->sentence,
        'created_at' => $faker->dateTimeBetween($startDate = '-4 months', $endDate = '-3 months'),
        'published_at' => $faker->date(),
        'view_count' => $faker->numberBetween(10, 1000),
        'slug' => $faker->slug,
    ];
});
