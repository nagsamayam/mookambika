<?php

namespace App\Models\Traits;

use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasRole
{
    /**
     * Get the role that owns the user.
     *
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin(): bool
    {
        return $this->isRole('admin');
    }

    public function isModerator(): bool
    {
        return $this->isRole('moderator');
    }

    public function isUser(): bool
    {
        return $this->isRole('user');
    }

    public function isElevated(): bool
    {
        return $this->isAdmin() OR $this->isModerator();
    }

    public function isRole($role): bool
    {
        return $this->role()->where('slug', $role)->exists();
    }

    public function inRoles($roles = []): bool
    {
        return $this->role()->whereIn('slug', (array)$roles)->exists();
    }
}