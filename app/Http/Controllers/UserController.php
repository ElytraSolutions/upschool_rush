<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Not allowed
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Done from another controller
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, User $user)
    {
        if ($request->user()->cannot('view', $user)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to view this user.',
            ], 403);
        }
        return $user->load('type');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if ($request->user()->cannot('update', $user)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to update this user.',
            ], 403);
        }
        if ($request->has('current_password')) {
            if (!password_verify($request->current_password, $user->password)) {
                return response([
                    'success' => false,
                    'message' => 'Current password is incorrect.',
                ], 403);
            }
        }
        $validated = $request->validated();
        $validated = $request->safe()->except('current_password');
        $user->update($validated);
        $user->save();
        return response([
            'success' => true,
            'message' => 'User updated successfully.',
            'data' => $user->load('type'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user)
    {
        if ($request->user()->cannot('update', $user)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to update this user.',
            ], 403);
        }
        $user->delete();
        return response([
            'success' => true,
            'message' => 'User deleted successfully.',
        ]);
    }

    public function myCourses(Request $request)
    {
        $dbQuery = <<<SQL
            SELECT c.name, c.slug, c.thumbnail, c.image, count(l.id) TotalLessons, count(lc.id) CompletedLessons
                FROM courses c
                LEFT JOIN chapters ch ON ch.course_id = c.id
                LEFT JOIN lessons l ON l.chapter_id = ch.id
                LEFT JOIN lesson_completions lc ON lc.lesson_id = l.id
                WHERE c.id IN (
                    SELECT course_id FROM course_enrollments
                        WHERE user_id = "{$request->user()->id}"
                )
                GROUP BY c.id, c.name, c.slug, c.image, c.thumbnail;
        SQL;
        $enrolledCourses = DB::select('' . $dbQuery . '');

        return [
            'success' => true,
            'data' => [
                'enrolled' => $enrolledCourses,
                // 'enrolled' => $request->user()->courses()->get(['courses.id', 'courses.slug', 'courses.name']),
                'completed' => $request->user()->courseCompletions(),
            ],
        ];
    }
}
