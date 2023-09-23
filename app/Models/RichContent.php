<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RichContent extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'rich_contents';

    protected $fillable = [
        'id',
        'html',
        'css',
        'js',
        'project_data',
    ];
}
