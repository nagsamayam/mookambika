<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Section::class, function (Faker $faker) {
    return [
        'title' => $faker->text(30)
    ];
});
