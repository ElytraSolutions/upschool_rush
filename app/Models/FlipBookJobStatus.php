<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlipBookJobStatus extends Model
{
    use HasFactory;
    use HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'flip_book_job_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'uploaded_by',
        'source_file',
        'destination_folder',
        'status',
        'data',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public static string $STATUS_PENDING = 'pending';
    public static string $STATUS_PROCESSING = 'processing';
    public static string $STATUS_COMPLETED = 'completed';
    public static string $STATUS_FAILED = 'failed';
}
