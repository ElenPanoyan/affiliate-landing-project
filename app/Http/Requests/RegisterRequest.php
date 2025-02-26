<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determines if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * User registration validation rules
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:255', 'unique:users', 'regex:/^[a-zA-Z0-9_]+$/', 'min:4'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'phone_number' => ['required', 'string', 'regex:/^\+?[0-9\s\-\(\)]{7,20}$/'],
            'country_code' => ['required', 'string', 'size:2'],
            'currency_code' => ['required', 'string', 'size:3'],
            'terms' => ['accepted'],
            'g-recaptcha-response' => ['required', 'string']
        ];
    }
}
