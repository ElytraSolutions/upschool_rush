<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRichContentRequest;
use App\Http\Requests\UpdateRichContentRequest;
use App\Models\RichContent;
use Illuminate\Http\Request;

class RichContentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return [
            'success' => true,
            'data' => RichContent::all(),
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Not required
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRichContentRequest $request)
    {
        if ($request->user()->cannot('create', RichContent::class)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to create content.',
            ], 403);
        }
        $validated = $request->validated();
        $richContent = RichContent::create($validated);
        return [
            'success' => true,
            'data' => $richContent,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(RichContent $richContent)
    {
        //
        return [
            'success' => true,
            'data' => $richContent,
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RichContent $richContent)
    {
        // Not implemented
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRichContentRequest $request, RichContent $richContent)
    {
        if ($request->user()->cannot('update', $richContent)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to update this content.',
            ], 403);
        }
        $validated = $request->validated();
        $richContent->update($validated);
        $richContent->save();
        return [
            'success' => true,
            'data' => $richContent,
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, RichContent $richContent)
    {
        if ($request->user()->cannot('delete', $richContent)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to delete this content.',
            ], 403);
        }
        $richContent->delete();
        return [
            'success' => true,
            'data' => $richContent,
        ];
    }
}
