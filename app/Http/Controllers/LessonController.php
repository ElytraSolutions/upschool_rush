<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->user()->cannot('viewAny', Lesson::class)) {
            return [
                'success' => false,
                'message' => 'You are not authorized to view lessons.',
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
        //
        if ($request->user()->cannot('create', Lesson::class)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to create lessons.',
            ], 403);
        }
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['title']);
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
        //
        if ($request->user()->cannot('view', $lesson)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to view this lesson.',
            ], 403);
        }
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
        //
        if ($request->user()->cannot('update', $lesson)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to update this lesson.',
            ], 403);
        }
        $validated = $request->validated();
        if(isset($validated['title'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }
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
        //
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
}
