<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    use Sluggable;
    use HasUuids;

    protected $table = 'lessons';

    protected $fillable = [
        'id',
        'name',
        'slug',
        'chapter_id',
        'priority',
        'active',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'priority' => 'integer',
        'active' => 'boolean',
    ];

    public function course()
    {
        return $this->chapter->course;
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }

    public function lessonSections()
    {
        return $this->hasMany(LessonSection::class);
    }

    public function lessonSectionContents()
    {
        return $this->hasManyThrough(LessonSectionContent::class, LessonSection::class, 'lesson_id', 'lesson_section_id');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
