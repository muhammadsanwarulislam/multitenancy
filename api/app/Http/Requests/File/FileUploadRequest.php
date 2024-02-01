<?php

namespace App\Http\Requests\File;

use Illuminate\Foundation\Http\FormRequest;

class FileUploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // You can define authorization logic here, if needed
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'attachment' => 'required|file|mimes:pdf,doc,docx,txt,jpeg,png,jpg,gif|max:2048',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'attachment.required' => 'The file is required.',
            'attachment.file' => 'The uploaded file is not valid.',
            'attachment.mimes' => 'The file must be one of the following types: pdf, doc, docx, txt, jpeg, png, jpg, gif.',
            'attachment.max' => 'The file size must not exceed 2048 kilobytes.',
        ];
    }
}
