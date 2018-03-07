<?php

function create($class, $attributes = [], $times = 1)
{
    $data = factory($class)->times($times)->create($attributes);
    if ($times > 1) {
        return $data;
    }

    return $data->first();
}

function make($class, $attributes = [], $times = null)
{
    return factory($class, $times)->make($attributes);
}

function random_mobile_number()
{
    for ($randomNumber = mt_rand(7, 9), $i = 1; $i < 10; $i++) {
        $randomNumber .= mt_rand(0, 9);
    }

    return $randomNumber;
}
