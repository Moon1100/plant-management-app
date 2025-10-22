<?php

namespace App\Policies;

use App\Models\Farm;
use App\Models\User;

class FarmPolicy
{
    public function viewAny(?User $user): bool
    {
        return true; // Anyone can view farm listings
    }

    public function view(?User $user, Farm $farm): bool
    {
        // Public can view if farm is public, or if user is owner
        return $farm->is_public || ($user && $user->id === $farm->user_id);
    }

    public function create(User $user): bool
    {
        return true; // Any authenticated user can create farms
    }

    public function update(User $user, Farm $farm): bool
    {
        return $user->id === $farm->user_id;
    }

    public function delete(User $user, Farm $farm): bool
    {
        return $user->id === $farm->user_id;
    }

    public function createPlant(User $user, Farm $farm): bool
    {
        return $user->id === $farm->user_id;
    }
}
