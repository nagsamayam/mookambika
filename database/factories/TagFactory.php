<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Tag::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->text(15),
        'meta_description' => $faker->sentence,
    ];
});
