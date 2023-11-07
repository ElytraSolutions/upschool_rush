<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulkRegistration extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'teacher_id',
        'csv_path',
        'status',
        'data',
    ];

    static $STATUS_PENDING = 'pending';
    static $STATUS_PROCESSING = 'processing';
    static $STATUS_COMPLETED = 'completed';
}
