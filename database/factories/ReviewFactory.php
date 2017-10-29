<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Review::class, function (Faker $faker) {
    return [
        'reviewer_name' => $faker->firstName() . ' ' . $faker->lastName,
        'reviewer_designation' => array_random(['Software Engineer', 'Product Manager', 'Project Mangager', 'Teacher']),
        'reviewer_organization' => array_random(['Janaagraha', 'Google', 'Facebook', 'Flipkart']),
        'reviewer_location' => array_random(['Hyderabad', 'Bangalore', 'Chennai', 'Delhi', 'Kolkata']),
        'content' => $faker->paragraph(5),
        'rating' => array_random([1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5]),
        'published_at' => $faker->dateTimeBetween($startDate = '-2 months', $endDate = 'now'),
        'created_at' => $faker->dateTimeBetween($startDate = '-4 months', $endDate = '-3 months'),
    ];
});
