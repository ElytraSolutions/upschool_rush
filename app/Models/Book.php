<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'teacher_email',
        'first_name',
        'last_name',
        'school_name',
        'country',
        'age',
        'path',
        'canva_link',
        'active',
    ];
}
