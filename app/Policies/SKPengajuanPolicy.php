<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SKPengajuan;

class SKPengajuanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role?->slug === 'bph_pb' || $user->role?->slug === 'admin';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SKPengajuan $sk): bool
    {
        return $user->role?->slug === 'bph_pb' || $user->role?->slug === 'admin';
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
    public function update(User $user, SKPengajuan $sk): bool
    {
        // Only pending SKs can be updated by submitter
        return ($user->id === $sk->submitted_by && $sk->status === 'pending') || $user->role?->slug === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SKPengajuan $sk): bool
    {
        return $user->role?->slug === 'admin';
    }

    /**
     * Only BPH PB can approve/reject/revise
     */
    public function approve(User $user, SKPengajuan $sk): bool
    {
        return $user->role?->slug === 'bph_pb' || $user->role?->slug === 'admin';
    }

    public function revise(User $user, SKPengajuan $sk): bool
    {
        return $user->role?->slug === 'bph_pb' || $user->role?->slug === 'admin';
    }

    public function reject(User $user, SKPengajuan $sk): bool
    {
        return $user->role?->slug === 'bph_pb' || $user->role?->slug === 'admin';
    }
}
