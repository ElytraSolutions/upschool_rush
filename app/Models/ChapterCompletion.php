<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterCompletion extends Model
{
    use HasFactory;

    protected $table = 'chapter_completion';
    protected $fillable = [
        'user_id',
        'chapter_id',
    ];
}
