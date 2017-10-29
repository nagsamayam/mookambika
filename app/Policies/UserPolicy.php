<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    /**
     * Determine if the current logged in user can see the admin section.
     *
     * @param User $user
     * @return bool
     */
    public function admin(User $user): bool
    {
        return $user->isElevated();
    }

}
