<?php

namespace App\Http\Requests;

use App\Rules\ValidFilename;
use App\Rules\ValidNumLines;
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
            'name' => 'required',
            'description' => 'string|nullable',
            'game' => 'required',
            'files' => 'required',
            'files.*' => ['mimetypes:text/plain,application/x-wine-extension-ini', 'max:128', new ValidNumLines, new ValidFilename]
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
		$messages = [
			'files.*.max' => 'Files may not be more than 128KB.',
			'files.*.mimes' => 'Files must be of type txt or ini'
		];

        return $messages;
    }
}
