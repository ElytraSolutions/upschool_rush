<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseDescription extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'course_descriptions';
    protected $fillable = [
        'id',
        'title',
        'subtitle',
        'description',
        'testimonials',
        'objectives',
        'steps',
        'faq',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'steps' => 'array',
        'faq' => 'array',
    ];

    public function getSustainabilityDetailsAttribute($value)
    {
        return array_values(json_decode($value, true) ?: []);
    }

    public function setSustainabilityDetailsAttribute($value)
    {
        $this->attributes['sustainability_details'] = json_encode(array_values($value));
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
