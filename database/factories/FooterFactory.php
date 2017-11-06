<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Footer::class, function (Faker $faker) {
    $title = $faker->text(40);
    $column1 = $column2 = $column3 = [];
    for ($i = 0; $i <= 5; $i++) {
        $column1[$i]['title'] = $faker->sentence(mt_rand(2, 3));
        $column1[$i]['href'] = $faker->url;
        $column1[$i]['new_window'] = rand(0, 1);
        $column2[$i]['title'] = $faker->sentence(mt_rand(2, 3));
        $column2[$i]['href'] = $faker->url;
        $column2[$i]['new_window'] = rand(0, 1);
        $column3[$i]['title'] = $faker->sentence(mt_rand(2, 3));
        $column3[$i]['href'] = $faker->url;
        $column3[$i]['new_window'] = rand(0, 1);
    }
    return [
        'title' => $title,
        'content' => json_encode([
            'column1' => [
                'title' => $faker->text(30),
                'links' => $column1
            ],
            'column2' => [
                'title' => $faker->text(40),
                'links' => $column2
            ],
            'column3' => [
                'title' => $faker->text(40),
                'links' => $column3
            ]]),
    ];
});
