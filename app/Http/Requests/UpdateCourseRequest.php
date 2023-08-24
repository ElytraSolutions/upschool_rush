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
            'name' => ['sometimes', 'string', 'max:255', 'unique:courses'],
            'intro' => ['sometimes', 'string', 'max:255'],
            'starredText' => ['sometimes', 'string', 'max:255'],
            'image' => ['sometimes', 'string', 'max:255'],
            'theme' => ['sometimes', 'string', 'max:255'],
            'description' => ['sometimes', 'string', 'max:4294967295'],
            'active' => ['sometimes', 'boolean'],
        ];
    }
}
