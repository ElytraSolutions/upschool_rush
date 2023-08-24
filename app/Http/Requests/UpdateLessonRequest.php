<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLessonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'chapter_id' => ['sometimes', 'exists:chapters,id'],
            'name' => ['sometimes', 'string', 'max:255'],
            'intro' => ['sometimes', 'string', 'max:255'],
            'content' => ['sometimes', 'string'],
            'active' => ['sometimes', 'in:0,1'],
        ];
    }
}
