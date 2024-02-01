<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileUpdateRequest extends FormRequest
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
    public function rules()
    {
        return [
            'first_name'     => 'required',
            'last_name'      => 'required',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required'       => 'The first_name field is required',
            'last_name.required'        => 'The last_name field is required.',
        ];
    }
}
