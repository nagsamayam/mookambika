<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Google Analytics
    |--------------------------------------------------------------------------
    |
    | Found in views/includes/partials/ga.blade.php
    */
    'google' => [
        'open' => env('GOOGLE_ANALYTICS_OPEN') ?: false,
        'id' => env('GOOGLE_ANALYTICS_ID', 'UA-XXXXX-X'),
    ]
];
