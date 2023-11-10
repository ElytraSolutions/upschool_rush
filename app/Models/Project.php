<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable =
    [
        'name',
        'intro',
        'description',
        'location',
        'genre',
        'image',
        'thumbnail',
        'sustainability_details',
        'active',
    ];

    protected $casts =
    [
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

    public function getSustainabilityDetailsAttribute($value)
    {
        return array_values(json_decode($value, true) ?: []);
    }

    public function setSustainabilityDetailsAttribute($value)
    {
        $this->attributes['sustainability_details'] = json_encode(array_values($value));
    }
}
