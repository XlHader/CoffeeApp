<?php

namespace App\Http\Requests\Auth;

use App\Traits\JsonValidationResponse;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    use JsonValidationResponse;

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
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ];
    }

    public function messages(): array {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name is invalid',
            'name.min' => 'Name cannot be less than 3 characters',
            'name.max' => 'Name cannot be more than 255 characters',
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'email.unique' => 'Email is already registered',
            'password.required' => 'Password is required',
            'password.string' => 'Password is invalid',
            'password.min' => 'Password cannot be less than 8 characters',
            'password.confirmed' => 'Password confirmation does not match'
        ];
    }
}
