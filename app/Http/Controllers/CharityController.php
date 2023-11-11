<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCharityRequest;
use App\Http\Requests\UpdateCharityRequest;
use App\Models\Charity;
use Illuminate\Http\Request;

class CharityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return [
            'success' => true,
            'data' => Charity::all(),
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
    public function store(StoreCharityRequest $request)
    {
        if ($request->user()->cannot('create', Charity::class)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to create charities.',
            ], 403);
        }
        $validated = $request->validated();
        $charity = Charity::create($validated);
        return [
            'success' => true,
            'data' => $charity,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Charity $charity)
    {
        return [
            'success' => true,
            'data' => $charity,
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Charity $charity)
    {
        // Done from frontend
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCharityRequest $request, Charity $charity)
    {
        if ($request->user()->cannot('update', $charity)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to update this charity.',
            ], 403);
        }
        $validated = $request->validated();
        $charity->update($validated);
        $charity->save();
        return [
            'success' => true,
            'data' => $charity,
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Charity $charity)
    {
        if ($request->user()->cannot('delete', $charity)) {
            return response([
                'success' => false,
                'message' => 'You are not authorized to delete this charity.',
            ], 403);
        }
        $charity->delete();
        return [
            'success' => true,
            'data' => $charity,
        ];
    }

    public function projects(Request $request, Charity $charity)
    {
        return [
            'success' => true,
            'data' => $charity->projects,
        ];
    }
}
