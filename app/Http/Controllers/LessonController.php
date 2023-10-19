<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Models\Lesson;
use App\Models\LessonCompletion;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Public Route
        if ($request->showAll) {
            return [
                'success' => true,
                'data' => Lesson::all(),
            ];
        }
        return [
            'success' => true,
            'data' => Lesson::all()->where('active', true),
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
    public function store(StoreLessonRequest $request)
    {
        if ($request->user()->cannot('create', Lesson::class)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to create lessons.',
            ], 403);
        }
        $validated = $request->validated();
        $lesson = Lesson::create($validated);
        return [
            'success' => true,
            'data' => $lesson,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(request $request, Lesson $lesson)
    {
        // Public Route
        return [
            'success' => true,
            'data' => $lesson,
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lesson $lesson)
    {
        // Done from frontend
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLessonRequest $request, Lesson $lesson)
    {
        if ($request->user()->cannot('update', $lesson)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to update this lesson.',
            ], 403);
        }
        $validated = $request->validated();
        $lesson->update($validated);
        $lesson->save();
        return [
            'success' => true,
            'data' => $lesson,
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Lesson $lesson)
    {
        if ($request->user()->cannot('delete', $lesson)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to delete this lesson.',
            ], 403);
        }
        return [
            'success' => true,
            'data' => $lesson->delete(),
        ];
    }

    /**
     * Check if lesson is already completed
     */
    public function checkCompletion(Request $request, Lesson $lesson)
    {
        if (!$request->user()->can('complete', $lesson)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to complete this lesson.',
            ], 403);
        }
        $lessonCompleted = LessonCompletion::where('user_id', $request->user()->id)
            ->where('lesson_id', $lesson->id)
            ->exists();
        return [
            'success' => true,
            'data' => $lessonCompleted,
        ];
    }

    /**
     * Mark the specified lesson as completed.
    */
    public function complete(Request $request, Lesson $lesson)
    {
        if (!$request->user()->can('complete', $lesson)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to complete this lesson.',
            ], 403);
        }
        $lessonCompleted = LessonCompletion::where('user_id', $request->user()->id)
            ->where('lesson_id', $lesson->id)
            ->exists();
        if ($lessonCompleted) {
            return response([
                'success' => false,
                'message' => 'You have already completed this lesson.',
            ], 400);
        }
        $lessonCompletion = new LessonCompletion;
        $lessonCompletion->user_id = $request->user()->id;
        $lessonCompletion->lesson_id = $lesson->id;
        $lessonCompletion->save();
        return [
            'success' => true,
            'data' => $lessonCompletion,
        ];
    }
}
