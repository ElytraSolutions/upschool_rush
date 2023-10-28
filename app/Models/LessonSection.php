<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LessonSection extends Model
{
    use HasFactory;
    use HasUuids;
    use Sluggable;

    protected $table = 'lesson_sections';

    protected $fillable = [
        'id',
        'name',
        'slug',
        'lesson_id',
        'priority',
        'active',
        'text',
        'teachers_note',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'active' => 'boolean',
    ];

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

    public function lessons(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function lessonSectionContents(): HasMany
    {
        return $this->hasMany(LessonSectionContent::class);
    }
}
