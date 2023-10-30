<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLessonSectionRequest;
use App\Http\Requests\UpdateLessonSectionRequest;
use App\Models\LessonSection;
use Illuminate\Http\Request;

class LessonSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAny', LessonSection::class)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to view lesson sections.',
            ], 403);
        }
        if ($request->showAll) {
            return [
                'success' => true,
                'data' => LessonSection::all(),
            ];
        }
        return [
            'success' => true,
            'data' => LessonSection::all()->where('active', true),
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
    public function store(StoreLessonSectionRequest $request)
    {
        if ($request->user()->cannot('create', LessonSection::class)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to create lesson sections.',
            ], 403);
        }
        $section = new LessonSection();
        $section->name = $request->name;
        $section->lesson_id = $request->lesson_id;
        $section->priority = $request->priority;
        $section->active = $request->active;
        $section->text = $request->text;
        $section->save();
        return [
            'success' => true,
            'data' => $section,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, LessonSection $lessonSection)
    {
        if ($request->user()->cannot('view', $lessonSection)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to view this lesson section.',
            ], 403);
        }
        return [
            'success' => true,
            'data' => $lessonSection,
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LessonSection $lessonSection)
    {
        // Done from frontend
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLessonSectionRequest $request, LessonSection $lessonSection)
    {
        if ($request->user()->cannot('update', $lessonSection)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to update this lesson section.',
            ], 403);
        }
        $section = $lessonSection;
        $section->name = $request->name;
        $section->lesson_id = $request->lesson_id;
        $section->priority = $request->priority;
        $section->active = $request->active;
        $section->text = $request->text;
        $section->save();
        return [
            'success' => true,
            'data' => $section,
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, LessonSection $lessonSection)
    {
        if ($request->user()->cannot('delete', $lessonSection)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to delete this lesson section.',
            ], 403);
        }
        return [
            'success' => true,
            'data' => $lessonSection->delete(),
        ];
    }
}
