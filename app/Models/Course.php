<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Course extends Model
{
    use HasFactory;
    use Sluggable;
    use HasUuids;

    protected $fillable = [
        'id',
        'name',
        'slug',
        'intro',
        'starredText',
        'image',
        'theme',
        'description',
        'text_description',
        'active',
        'course_category_id',
        'tagline',
        'thumbnail',
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

    public function courseCategory()
    {
        return $this->belongsTo(CourseCategory::class);
    }

    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class);
    }

    public function lessons()
    {
        return $this->hasManyThrough(Lesson::class, Chapter::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'course_enrollments');
    }

    public function course_description()
    {
        return $this->hasOne(CourseDescription::class, 'course_id', 'id');
    }

    public function description(): HasOne
    {
        return $this->hasOne(CourseDescription::class, 'course_id');
    }

    public function completion()
    {
        return $this->hasOne(CourseCompletion::class);
    }
}
