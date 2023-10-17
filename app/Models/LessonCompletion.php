<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonCompletion extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'lesson_completions';

    protected $fillable = [
        'user_id',
        'lesson_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
