<?php

namespace App\Policies;

use App\Models\CourseEnrollment;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LessonPolicy
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
    public function view(?User $user, Lesson $lesson): bool
    {
        //
        return $user->can('view', $lesson->chapter->course);
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
    public function update(User $user, Lesson $lesson): bool
    {
        //
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Lesson $lesson): bool
    {
        //
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Lesson $lesson): bool
    {
        //
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Lesson $lesson): bool
    {
        //
        return false;
    }

    /**
     * Determine whether the user can mark the lesson as complete.
     */
    public function complete(User $user, Lesson $lesson): bool
    {
        if ($user->cannot('view', $lesson)) {
            return false;
        }
        $userEnrolled = CourseEnrollment::query()
            ->where('user_id', $user->id)
            ->where('course_id', $lesson->chapter->course->id)
            ->exists();
        if (!$userEnrolled) {
            return false;
        }
        return true;
    }
}
