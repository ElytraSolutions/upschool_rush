<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookValidation extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'book_validation';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'book_hash',
        'data',
    ];
}
