<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFlipBookJobStatusRequest;
use App\Http\Requests\UpdateFlipBookJobStatusRequest;
use App\Models\FlipBookJobStatus;

class FlipBookJobStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreFlipBookJobStatusRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FlipBookJobStatus $flipBookJobStatus)
    {
        return $flipBookJobStatus;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FlipBookJobStatus $flipBookJobStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFlipBookJobStatusRequest $request, FlipBookJobStatus $flipBookJobStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FlipBookJobStatus $flipBookJobStatus)
    {
        //
    }
}
