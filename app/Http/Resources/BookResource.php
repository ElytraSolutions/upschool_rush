<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;



class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */


    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' =>  $this->slug,
            'description' => $this->description,
            'teacher_email' => $this->teacher_email,
            'first_name' => $this->first_name,
            'school_name' => $this->school_name,
            'country' => $this->country,
            'age' => $this->age,
            'path' => $this->path,
            'canva_link' => $this->canva_link,
            'active' => $this->active,
            'categories'=>CategoryResource::collection($this->categories),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

}
