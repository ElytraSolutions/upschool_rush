<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'title' => ['string', 'max:255'],
            'description' => ['string'],
            'teacher_email' => ['string', 'email', 'max:255'],
            'first_name' => ['string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'school_name' => ['string', 'max:255'],
            'country' => ['string', 'max:255'],
            'age' => ['integer'],
            'active' => ['integer', 'in:0,1'],
            'path' => ['string', 'max:255'],
            'canva_link' => ['string', 'max:255'],
        ];
    }
}
