<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
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
                'data' => Project::all(),
            ];
        }
        return [
            'success' => true,
            'data' => Project::all()->where('active', true),
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
    public function store(StoreProjectRequest $request)
    {
        if ($request->user()->cannot('create', Project::class)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to create projects.',
            ], 403);
        }
        $validated = $request->validated();
        $project = Project::create($validated);
        return [
            'success' => true,
            'data' => $project,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Project $project)
    {
        // Public Route
        return [
            'success' => true,
            'data' => $project,
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        // Done from frontend
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        if ($request->user()->cannot('update', $project)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to update this project.',
            ], 403);
        }
        $validated = $request->validated();
        $project->update($validated);
        $project->save();
        return [
            'success' => true,
            'data' => $project,
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Project $project)
    {
        if ($request->user()->cannot('delete', $project)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to delete this project.',
            ], 403);
        }
        return [
            'success' => true,
            'data' => $project->delete(),
        ];

    }
}
