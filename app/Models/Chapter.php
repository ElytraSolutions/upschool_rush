<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'description',
        'course_id',
    ];

    protected $casts=[
        'created_at'=>'datetime',
        'updated_at'=>'datetime',
        'active'=>'boolean',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }


}
