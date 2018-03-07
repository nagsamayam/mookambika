<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;

    protected $fillable = ['title', 'slug'];

    /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * The admins that belong to the role.
     */
    public function admins()
    {
        return $this->hasMany(Admin::class);
    }
}
