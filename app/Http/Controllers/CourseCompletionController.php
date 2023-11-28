<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseCompletionRequest;
use App\Http\Requests\UpdateCourseCompletionRequest;
use App\Models\Course;
use App\Models\CourseCompletion;
use Illuminate\Support\Facades\DB;
use App\Utils\fpdf186\FPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseCompletionController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Course $course)
    {
        $userId = $request->user()->id;
        $courseLessonCount = $course->lessons()->count();
        $completedLessonCount = DB::table('lesson_completions')
            ->where('user_id', $userId)
            ->whereIn('lesson_id', function ($query) use ($course) {
                $query->select('lessons.id')
                    ->from('lessons')
                    ->join('chapters', 'lessons.chapter_id', '=', 'chapters.id')
                    ->join('courses', 'chapters.course_id', '=', 'courses.id')
                    ->where('course_id', $course->id);
            })
            ->count();
        if ($completedLessonCount === $courseLessonCount) {
            $currentCompletion = CourseCompletion::where('user_id', $userId)
                ->where('course_id', $course->id);
            if (!$currentCompletion->exists() || $currentCompletion->certificate_path !== null) {
                $name = $request->user()->first_name . ' ' . $request->user()->last_name;
                $pdf = $this->generatePDF($name, $course->name);
                $output = $pdf->Output('S');
                $storagePath = 'certificates/' . $userId . '/' . $course->slug . '.pdf';
                Storage::disk('s3')->put($storagePath, $output);
                $currentCompletion = CourseCompletion::create([
                    'user_id' => $userId,
                    'course_id' => $course->id,
                    'certificate_path' => $storagePath,
                ]);
            }
            return response()->json([
                'success' => true,
                'message' => 'You have completed this course.',
                'certificate_url' => Storage::disk('s3')->url($currentCompletion->certificate_path),
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'You have not completed all the lessons in this course.',
                'total_lessons' => $courseLessonCount,
                'completed_lessons' => $completedLessonCount,
            ], 403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseCompletion $courseCompletion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseCompletion $courseCompletion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseCompletionRequest $request, CourseCompletion $courseCompletion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseCompletion $courseCompletion)
    {
        //
    }

    function generatePDF($user, $course)
    {
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddFont('GoodVibrations', '', 'GoodVibrations-Script-400.php');
        $pdf->AddFont('NunitoSans', 'B', 'NunitoSans_10pt-SemiBold.php');
        $pdf->AddFont('KumbhSans', '', 'KumbhSans-Regular.php');
        $pdf->AddPage();
        $pdf->SetMargins(0, 0, 0);

        $pdf->Image(storage_path('app/public/Certificate_base.png'), 0, 0, 210, 297);

        $pdf->Ln(125);

        $pdf->SetTextColor(3, 1, 76);
        $pdf->SetFont('GoodVibrations', '', '26');
        $pdf->Cell(0, 30, $user, 0, 1, 'C');

        $pdf->Ln(6);
        $pdf->SetFont('NunitoSans', 'B', '10.5');
        $pdf->SetTextColor(29, 14, 76);
        $pdf->Cell(0, 10, "\"$course\" course", 0, 1, 'C');
        return $pdf;
    }
}
