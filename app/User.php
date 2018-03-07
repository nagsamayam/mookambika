<?php

namespace App;

use App\Models\Traits\HasRole;
use App\Models\Traits\UserRelationshipTrait as RelationshipTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasRole, Notifiable, RelationshipTrait;

    protected $fillable = [
        'full_name', 'email', 'password', 'confirmed',
        'confirmation_code', 'role_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function fullName(): string
    {
        return $this->full_name;
    }

    public function emailAddress(): string
    {
        return $this->email;
    }

    public function isConfirmed(): bool
    {
        return (bool) $this->confirmed;
    }

    public function isUnconfirmed(): bool
    {
        return !$this->isConfirmed();
    }

    public function confirmationCode(): string
    {
        return (string) $this->confirmation_code;
    }

    public function matchesConfirmationCode(string $code): bool
    {
        return $this->confirmation_code === $code;
    }

    public function hasPassword(): bool
    {
        $password = $this->getAuthPassword();

        return $password !== '' && $password !== null;
    }
}
