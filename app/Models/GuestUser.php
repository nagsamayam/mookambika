<?php

namespace App\Models;

use App\User;

class GuestUser extends User
{
    protected $table = 'users';
}
