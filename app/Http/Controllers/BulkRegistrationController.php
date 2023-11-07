<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBulkRegistrationRequest;
use App\Http\Requests\UpdateBulkRegistrationRequest;
use App\Jobs\BulkRegistrationJob;
use App\Models\BulkRegistration;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BulkRegistrationController extends Controller
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
    public function store(StoreBulkRegistrationRequest $request)
    {
        if ($request->user()->cannot('create', BulkRegistration::class)) {
            return [
                'success' => false,
                'message' => 'You are not authorized to add students.',
            ];
        }
        $validated = $request->validated();
        $validated['teacher_id'] = $request->user()->id;
        $validated['csv_path'] = $request->file('file')->store('bulk-registrations', 's3');
        if (!$validated['csv_path']) {
            return [
                'success' => false,
                'message' => 'Error while uploading file.',
            ];
        }
        $validated['status'] = BulkRegistration::$STATUS_PENDING;
        $bulkRegistration = BulkRegistration::create($validated);
        BulkRegistrationJob::dispatch($bulkRegistration);
        return [
            'success' => true,
            'message' => 'Bulk registration started.',
            'data' => $bulkRegistration,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(BulkRegistration $bulkRegistration)
    {
        if (request()->user()->cannot('view', $bulkRegistration)) {
            return [
                'success' => false,
                'message' => 'You are not authorized to view this bulk registration.',
            ];
        }
        return [
            'success' => true,
            'data' => $bulkRegistration,
        ];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BulkRegistration $bulkRegistration)
    {
        // Not required
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBulkRegistrationRequest $request, BulkRegistration $bulkRegistration)
    {
        // Not required
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BulkRegistration $bulkRegistration)
    {
        // Not required
    }
}
