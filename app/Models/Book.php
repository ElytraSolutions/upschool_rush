<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Book extends Model
{
    use HasFactory;
    use Sluggable;

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

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
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
                'source' => 'title'
            ]
        ];
    }


    public function categories(){
        return $this->belongsToMany(Category::class,'book_categories','book_id','category_id');
    }

    public function projects(){
        return $this->belongsToMany(Project::class,'book_projects','book_id','project_id');
    }


}
