<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'intro' => ['required', 'string', 'max:255'],
            'starredText' => ['string', 'max:255'],
            'image' => ['string', 'max:255'],
            'theme' => ['string', 'max:255'],
            'description' => ['required', 'string', 'max:4294967295'],
            'active' => ['in:0,1'],
        ];
    }
}
