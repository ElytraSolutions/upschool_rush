<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'missing',
            'email' => 'missing',
            'email_verified_at' => 'missing',
            'current_password' => 'required_with:password',
            'password' => ['string', 'min:8', 'confirmed'],
            'avatar' => 'missing',
            'remember_token' => 'missing',
            'created_at' => 'missing',
            'updated_at' => 'missing',
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'country' => 'string|max:255',
            'date_of_birth' => 'date',
            'user_type_id' => 'integer|exists:user_types,id',
            'is_admin' => 'missing',
        ];
    }
}
