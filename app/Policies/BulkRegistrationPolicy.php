<?php

namespace App\Policies;

use App\Models\BulkRegistration;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BulkRegistrationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, BulkRegistration $bulkRegistration): bool
    {
        return $user->isTeacher() && $user->id === $bulkRegistration->teacher_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isTeacher();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BulkRegistration $bulkRegistration): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BulkRegistration $bulkRegistration): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, BulkRegistration $bulkRegistration): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, BulkRegistration $bulkRegistration): bool
    {
        return false;
    }
}
