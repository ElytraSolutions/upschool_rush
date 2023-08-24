<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'slug',
        'intro',
        'content',
        'active',
        'chapter_id',
    ];

    protected $casts=[
        'created_at'=>'datetime',
        'updated_at'=>'datetime',
        'active'=>'boolean',
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
}
