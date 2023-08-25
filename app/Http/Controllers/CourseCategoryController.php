<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseCategory;

class CourseCategoryController extends Controller
{
    public function index()
    {
        return [
            'success' => true,
            'data' => CourseCategory::all(),
        ];
    }

    public function courses(CourseCategory $courseCategory)
    {
        return [
            'success' => true,
            'data' => $courseCategory->courses,
        ];
    }
}
