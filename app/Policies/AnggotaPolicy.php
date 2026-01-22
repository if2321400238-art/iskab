<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Anggota;

class AnggotaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return auth()->check();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Anggota $anggota): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array($user->role?->slug, ['admin', 'bph_korwil', 'bph_rayon']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Anggota $anggota): bool
    {
        return in_array($user->role?->slug, ['admin', 'bph_korwil', 'bph_rayon']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Anggota $anggota): bool
    {
        return $user->role?->slug === 'admin' || $user->role?->slug === 'bph_korwil';
    }
}
