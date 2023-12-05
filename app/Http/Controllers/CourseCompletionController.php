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

require_once __DIR__ . '/../../Utils/fpdf186/FPDF.php';
require_once __DIR__ . '/../../Utils/FPDI/src/autoload.php';

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

        $currentCompletion = CourseCompletion::where('user_id', $userId)
            ->where('course_id', $course->id)->first();

        if ($currentCompletion && $currentCompletion->exists() && $currentCompletion["certificate_path"] !== null) {
            return response()->json([
                'success' => true,
                'message' => 'You have completed this course.',
                'certificate_url' => Storage::disk('s3')->url($currentCompletion->certificate_path),
            ], 201);
        }

        $courseworkType = $request->input('coursework_type');
        if ($courseworkType === 'link') {
            $coursework_path = $request->input('coursework');
        } else if ($courseworkType === 'file' && $request->hasFile('coursework')) {
            $coursework_path = $request->file('coursework')->store('coursework/' . $userId . '/' . $course->slug, 's3');
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid coursework type.',
            ], 400);
        }

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
            $name = $request->user()->first_name . ' ' . $request->user()->last_name;
            $name = ucwords(strtolower($name));
            $pdf = $this->generatePDF($name, $course->name);
            $output = $pdf->Output('S');
            $storagePath = 'certificates/' . $userId . '/' . $course->slug . '.pdf';
            Storage::disk('s3')->put($storagePath, $output);
            $currentCompletion = CourseCompletion::create([
                'user_id' => $userId,
                'course_id' => $course->id,
                'coursework_path' => $coursework_path,
                'certificate_path' => $storagePath,
            ]);
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
        $pdf = new \setasign\Fpdi\Fpdi();

        $pageCount = $pdf->setSourceFile(__DIR__ . '/../../../resources/CertificateBase.pdf');
        $pageId = $pdf->importPage(1, \setasign\Fpdi\PdfReader\PageBoundaries::MEDIA_BOX);
        $pdf->AddFont('GoodVibrations', '', 'GoodVibrations-Script-400.php');
        $pdf->AddFont('GreatVibes', '', 'GreatVibes-Regular.php');
        $pdf->AddFont('NunitoSans', 'B', 'NunitoSans_10pt-SemiBold.php');
        $pdf->AddFont('KumbhSans', '', 'KumbhSans-Regular.php');
        $pdf->AddPage();
        $pdf->useImportedPage($pageId);
        $pdf->SetMargins(0, 0, 0);

        // $pdf->Image(__DIR__ . '../resources/Certificate_base.png', 0, 0, 210, 297);

        $pdf->Ln(110);

        $pdf->SetTextColor(3, 1, 76);
        $pdf->SetFont('GreatVibes', '', '32');
        $pdf->Cell(0, 30, $user, 0, 1, 'C');

        $pdf->SetFont('NunitoSans', 'B', '10.5');
        $pdf->SetTextColor(29, 14, 76);
        $pdf->Cell(0, 5, 'for submitting a work task to Upschool indicating completion of the', 0, 1, 'C');
        $pdf->Cell(0, 5, "\"$course\" course", 0, 1, 'C');
        return $pdf;
    }
}
