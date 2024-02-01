<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username'          => 'required|username|unique:users',
            'email'             => 'required|email|unique:users',
            'password'          => 'required|string|min:8|max:255|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'username.required'       => 'The username field is required',
            'email.required'          => 'The email field is required.',
            'password.required'       => 'The password filed is required.',
            'password.min'            => 'The password length must be at least 8 characters',
        ];
    }
}
