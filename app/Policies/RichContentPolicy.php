<?php

namespace App\Policies;

use App\Models\RichContent;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RichContentPolicy
{
    /*
        * Allow admins to perform any action.
    */
    public function before(User $user, string $ability): bool|null
    {
        if ($user && $user->isAdmin()) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RichContent $richContent): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RichContent $richContent): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RichContent $richContent): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, RichContent $richContent): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, RichContent $richContent): bool
    {
        return false;
    }
}
