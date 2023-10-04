<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseEnrollmentRequest;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Models\CourseEnrollment;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Public route
        if ($request->showAll) {
            return [
                'success' => true,
                'data' => Course::all(),
            ];
        }
        return [
            'success' => true,
            'data' => Course::all()->where('active', true),
        ];
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
    public function store(StoreCourseRequest $request)
    {
        if ($request->user()->cannot('create', Course::class)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to create courses.',
            ], 403);
        }
        $validated = $request->validated();
        $course = Course::create($validated);
        return [
            'success' => true,
            'data' => $course,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Course $course)
    {
        // Public route
        return [
            'success' => true,
            'data' => $course,
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        // Done from frontend
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        if ($request->user()->cannot('update', $course)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to update this course.',
            ], 403);
        }
        $validated = $request->validated();
        $course->update($validated);
        $course->save();
        return [
            'success' => true,
            'data' => $course,
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Course $course)
    {
        //
        if ($request->user()->cannot('delete', $course)) {
            return [
                'success' => false,
                'message' => 'You are not authorized to delete this course.',
            ];
        }
        return [
            'success' => true,
            'data' => $course->delete(),
        ];
    }

    /**
     * Return a listing of the students enrolled in the course.
    */
    public function students(Course $course) {
        return [
            'success' => true,
            'data' => $course->users,
        ];
    }

    /**
     * Check if user is enrolled in the course
     */
    public function checkEnrollment(Request $request, Course $course)
    {
        $courseEnrollment = CourseEnrollment::where('course_id', $course->getAttribute('id'))
            ->where('user_id', $request->user()->getAttribute('id'))
            ->first();
        $firstChapter = $course->chapters->first();
        $lastChapter = $course->chapters->last();
        $lastCompletedChapter = $request->user()->lastCompletedChapter($course);
        if ($lastCompletedChapter !== null) {
            $course['lastCompletedChapter'] = $lastCompletedChapter;
        }
        if ($courseEnrollment === null) {
            return [
                'success' => true,
                'data' => [
                    'enrolled' => false,
                ],
            ];
        }
        return [
            'success' => true,
            'data' => [
                'enrolled' => true,
                'firstChapter' => $firstChapter,
                'lastChapter' => $lastChapter,
                'courseEnrollment' => $courseEnrollment,
                'lastCompletedChapter' => $lastCompletedChapter,
            ],
        ];
    }

    /**
     * Enrolls the user in the course.
    */
    public function enroll(Request $request, Course $course)
    {
        $courseEnrollment = CourseEnrollment::where('course_id', $course->getAttribute('id'))
            ->where('user_id', $request->user()->getAttribute('id'))
            ->first();
        if ($courseEnrollment !== null) {
            return [
                'success' => false,
                'message' => 'You are already enrolled in this course.',
            ];
        }
        $request->merge([
            'course_id' => $course->getAttribute('id'),
            'user_id' => $request->user()->getAttribute('id'),
        ]);
        $rules = (new StoreCourseEnrollmentRequest)->rules();
        $validated = $request->validate($rules);
        $data = CourseEnrollment::create($validated);
        $data['chapter'] = $course->chapters->first();
        return [
            'success' => true,
            'data' => $data,
        ];
    }

    /**
     * Unenrolls the user from the course.
    */
    public function unenroll(Request $request, Course $course)
    {
        $courseEnrollment = CourseEnrollment::where('course_id', $course->getAttribute('id'))
            ->where('user_id', $request->user()->getAttribute('id'))
            ->first();
        if ($courseEnrollment === null) {
            return [
                'success' => false,
                'message' => 'You are not enrolled in this course.',
            ];
        }
        return [
            'success' => true,
            'data' => $courseEnrollment->delete(),
        ];
    }

    /**
     * Return a listing of the resource's chapters.
     */
    public function chapters(Request $request, Course $course)
    {
        return [
            'success' => true,
            'data' => $course->chapters,
        ];
    }
}
