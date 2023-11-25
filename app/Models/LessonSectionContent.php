<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonSectionContent extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'lesson_section_contents';
    protected $fillable = [
        'id',
        'name',
        'type',
        'lesson_section_id',
        'source',
        'content',
        'priority',
        'active',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'priority' => 'integer',
        'active' => 'boolean',
    ];

    public function lessonSection()
    {
        return $this->belongsTo(LessonSection::class, 'lesson_section_id');
    }
}
