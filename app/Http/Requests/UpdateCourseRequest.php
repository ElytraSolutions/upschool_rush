<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
{
    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = false;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'intro' => ['string', 'max:255'],
            'starredText' => ['string', 'max:255'],
            'image' => ['string', 'max:255'],
            'theme' => ['string', 'max:255'],
            'description' => ['string', 'max:4294967295'],
            'active' => ['integer', 'in:0,1'],
            'course_category_id' => ['integer', 'exists:course_categories,id'],
            'tagline' => ['string', 'max:255'],
            'thumbnail' => ['string', 'max:255'],
        ];
    }
}
