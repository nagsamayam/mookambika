<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Role::class, function (Faker $faker) {
    $title = $faker->unique()->word;
    return [
        'title' => $title,
        'slug' => $title
    ];
});
