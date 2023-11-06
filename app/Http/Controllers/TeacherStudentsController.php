<?php

namespace App\Http\Controllers;

use App\Http\Requests\InviteStudentRequest;
use App\Http\Requests\StoreTeacherStudentsRequest;
use App\Http\Requests\UpdateTeacherStudentsRequest;
use App\Mail\InviteStudent;
use App\Models\TeacherStudents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TeacherStudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->user()->cannot('viewAny', TeacherStudents::class)) {
            return [
                'success' => false,
                'message' => 'You are not authorized to view students.',
            ];
        }
        return [
            'success' => true,
            'data' => TeacherStudents::where('teacher_id', request()->user()->id)->get(),
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
    public function store(StoreTeacherStudentsRequest $request)
    {
        if ($request->user()->cannot('create', TeacherStudents::class)) {
            return [
                'success' => false,
                'message' => 'You are not authorized to add students.',
            ];
        }
        $validated = $request->validated();
        $validated['student_id'] = $request->user()->id;
        $teacherStudents = TeacherStudents::create($validated);
        return [
            'success' => true,
            'message' => 'Student added successfully.',
            'data' => $teacherStudents,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(TeacherStudents $teacherStudents)
    {
        // Not required
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TeacherStudents $teacherStudents)
    {
        // Not required
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeacherStudentsRequest $request, TeacherStudents $teacherStudents)
    {
        // Not required
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TeacherStudents $teacherStudents)
    {
        // Not required
    }

    public function inviteStudent(InviteStudentRequest $request)
    {
        $validated = $request->validated();
        Mail::to($validated['email'])->send(new InviteStudent($validated['inviteLink']));
        return [
            'success' => true,
            'message' => 'Student invited successfully.',
        ];
    }
}
