<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->user()->cannot('viewAny', Course::class)) {
            return [
                'success' => false,
                'message' => 'You are not authorized to view courses.',
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
        //
        if ($request->user()->cannot('create', Course::class)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to create courses.',
            ], 403);
        }
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['name']);
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
        //
        if ($request->user()->cannot('view', $course)) {
            return [
                'success' => false,
                'message' => 'You are not authorized to view this course.',
            ];
        }
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
        //
        if ($request->user()->cannot('update', $course)) {
            return [
                'success' => false,
                'message' => 'You are not authorized to update this course.',
            ];
        }
        $validated = $request->validated();
        if (isset($validated['name'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }
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
        $course->delete();
    }
}
