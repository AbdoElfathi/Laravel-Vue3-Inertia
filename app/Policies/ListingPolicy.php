<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;

class ListingPolicy
{
    public function before(?User $user, $ability)
    {
        if ($user?->is_admin) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Listing $listing)
    {
        if ($listing->user_id === $user?->id) {
            return true;
        }

        return $listing->sold_at === null;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Listing $listing)
    {
        return $listing->sold_at === null && $user->id === $listing->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Listing $listing)
    {
        return $user->id === $listing->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Listing $listing)
    {
        return $user->id === $listing->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Listing $listing)
    {
        return $user->id === $listing->user_id;
    }
}
