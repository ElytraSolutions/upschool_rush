<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLessonRequest extends FormRequest
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
            //
            'chapter_id' => ['integer', 'exists:chapters,id'],
            'name' => ['string', 'max:255'],
            'intro' => ['string', 'max:255'],
            'content' => ['string'],
            'content_json' => ['string'],
            'active' => ['integer', 'in:0,1'],
        ];
    }
}
