<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseEnrollmentRequest;
use App\Http\Requests\UpdateCourseEnrollmentRequest;
use App\Models\Course;
use App\Models\CourseEnrollment;
use Illuminate\Http\Request;

class CourseEnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Use user controller instead
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Done from frontend
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseEnrollmentRequest $request)
    {
        //
        if ($request->user()->cannot('create', CourseEnrollment::class)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to create enrollments.',
            ], 403);
        }
        $validated = $request->validated();
        if(!array_key_exists('user_id', $validated)) {
            $validated['user_id'] = $request->user()->id;
        }
        $courseEnrollment = CourseEnrollment::create($validated);
        return [
            'success' => true,
            'data' => $courseEnrollment,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, CourseEnrollment $courseEnrollment)
    {
        //
        if ($request->user()->cannot('view', $courseEnrollment)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to view this enrollment.',
            ], 403);
        }
        return [
            'success' => true,
            'data' => $courseEnrollment,
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseEnrollment $courseEnrollment)
    {
        // Done from frontend
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseEnrollmentRequest $request, CourseEnrollment $courseEnrollment)
    {
        //
        if ($request->user()->cannot('update', $courseEnrollment)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to update enrollments.',
            ], 403);
        }
        $validated = $request->validated();
        $courseEnrollment->update($validated);
        $courseEnrollment->save();
        return [
            'success' => true,
            'data' => $courseEnrollment,
        ];

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, CourseEnrollment $courseEnrollment)
    {
        //
        if ($request->user()->cannot('delete', $courseEnrollment)) {
            return [
                'success' => false,
                'message' => 'You are not authorized to delete this enrollment.',
            ];
        }
        return [
            'success' => true,
            'data' => $courseEnrollment->delete(),
        ];
    }
}
