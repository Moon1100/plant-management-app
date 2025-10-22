<?php

namespace App\Policies;

use App\Models\Plant;
use App\Models\User;

class PlantPolicy
{
    public function viewAny(?User $user): bool
    {
        return true; // Anyone can view plant listings
    }

    public function view(?User $user, Plant $plant): bool
    {
        // Public can view if farm is public, or if user is owner
        return $plant->farm->is_public || ($user && $user->id === $plant->farm->user_id);
    }

    public function create(User $user): bool
    {
        return true; // Any authenticated user can create plants (if they own farms)
    }

    public function update(User $user, Plant $plant): bool
    {
        return $user->id === $plant->farm->user_id;
    }

    public function delete(User $user, Plant $plant): bool
    {
        return $user->id === $plant->farm->user_id;
    }

    public function addUpdate(User $user, Plant $plant): bool
    {
        return $user->id === $plant->farm->user_id;
    }
}
