<?php

namespace App\Policies;

use App\Models\CourseEnrollment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CourseEnrollmentPolicy
{
    /*
        * Allow admins to perform any action.
    */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isAdmin()) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CourseEnrollment $courseEnrollment): bool
    {
        //
        return $user->getAttribute('id') === $courseEnrollment->getAttribute('user_id');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        $input = request()->input();
        return !array_key_exists('user_id', $input) || $user->getAttribute('id') === $input['user_id'];
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CourseEnrollment $courseEnrollment): bool
    {
        //
        return $user->getAttribute('id') === $courseEnrollment->getAttribute('user_id');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CourseEnrollment $courseEnrollment): bool
    {
        //
        return $user->getAttribute('id') === $courseEnrollment->getAttribute('user_id');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CourseEnrollment $courseEnrollment): bool
    {
        //
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CourseEnrollment $courseEnrollment): bool
    {
        //
        return false;
    }
}
