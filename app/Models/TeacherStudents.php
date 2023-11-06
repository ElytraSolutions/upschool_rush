<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherStudents extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'teacher_students';

    protected $fillable = [
        'teacher_id',
        'student_id',
    ];
}
