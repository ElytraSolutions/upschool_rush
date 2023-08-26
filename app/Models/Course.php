<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Course extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'intro',
        'starredText',
        'image',
        'theme',
        'description',
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

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
}
