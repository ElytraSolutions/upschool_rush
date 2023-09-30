<?php

namespace App\Policies;

use App\Models\Chapter;
use App\Models\CourseEnrollment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ChapterPolicy
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
    public function viewAny(?User $user): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Chapter $chapter): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Chapter $chapter): bool
    {
        //
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Chapter $chapter): bool
    {
        //
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Chapter $chapter): bool
    {
        //
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Chapter $chapter): bool
    {
        //
        return false;
    }

    /**
     * Determine whether the user can mark the chapter as complete.
    */
    public function complete(User $user, Chapter $chapter): bool
    {
        if ($user->cannot('view', $chapter))
        {
            return false;
        }
        $userEnrolled = CourseEnrollment::query()
            ->where('user_id', $user->id)
            ->where('course_id', $chapter->course->id)
            ->exists();
        if (!$userEnrolled) {
            return false;
        }
        return true;
    }
}
