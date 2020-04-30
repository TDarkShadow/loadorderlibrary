<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpload extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // True. Everyone is allowed to upload.
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
            'name' => auth()->check() ? 'required' : '',
            'description' => 'string|nullable',
            'private' => 'boolean',
            'games' => 'required',
            'files' => 'required',
            'files.*' => 'mimes:txt,ini|max:16'
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
            'files.*.max' => 'Files may not be more than 16KB.',
            'files.*.mimes' => 'Files must be of type txt or ini'
        ];
    }
}
