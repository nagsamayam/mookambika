<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Page::class, function (Faker $faker) {
    return [
        'layout'              => array_random(['default', 'landing_page']),
        'type'                => array_random(['home', 'landing_page1', 'landing_page2', 'landing_page3']),
        'title'               => $faker->text(70),
        'footer_id'           => create(\App\Models\Footer::class)->id,
        'footer_title'        => $faker->sentence,
        'color'               => $faker->hexcolor,
        'seo_title'           => $faker->text(30),
        'meta_description'    => $faker->sentence,
        'slug'                => $faker->slug,
        'view_count'          => $faker->numberBetween(10, 1000),
        'internal_link_count' => $faker->numberBetween(1, 20),
        'external_link_count' => $faker->numberBetween(1, 20),
        'created_at'          => $faker->dateTimeBetween($startDate = '-4 months', $endDate = '-3 months'),
        'published_at'        => $faker->dateTimeBetween($startDate = '-2 months', $endDate = 'now'),
    ];
});
