<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'country' => ['required', 'string'],
            'date_of_birth' => ['required', 'date'],
            'user_type_id' => ['required', 'exists:user_types,id']
        ];
    }
}
