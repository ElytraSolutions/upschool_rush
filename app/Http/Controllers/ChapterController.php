<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChapterRequest;
use App\Http\Requests\UpdateChapterRequest;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChapterController extends Controller
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
                'data' => Chapter::all(),
            ];
        }
        return [
            'success' => true,
            'data' => Chapter::all()->where('active', true),
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
    public function store(StoreChapterRequest $request)
    {
        if ($request->user()->cannot('create', Chapter::class)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to create chapters.',
            ], 403);
        }
        $validated = $request->validated();
        $book = Chapter::create($validated);
        return [
            'success' => true,
            'data' => $book,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Chapter $chapter)
    {
        // Public route
        return [
            'success' => true,
            'data' => $chapter,
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chapter $book)
    {
        // Done from frontend
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChapterRequest $request, Chapter $chapter)
    {
        if ($request->user()->cannot('update', $chapter)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to update this chapter.',
            ], 403);
        }
        $validated = $request->validated();
        $chapter->update($validated);
        $chapter->save();
        return [
            'success' => true,
            'data' => $chapter,
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Chapter $chapter)
    {
        if ($request->user()->cannot('delete', $chapter)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to delete this chapter.',
            ], 403);
        };
        return [
            'success' => true,
            'data' => $chapter->delete(),
        ];
    }

    /**
     * Return a listing of the resource's lessons.
     */
    public function chapters(Request $request, Chapter $chapter)
    {
        return [
            'success' => true,
            'data' => $chapter->lessons,
        ];
    }
}
