<?php

namespace App\Http\Requests;

use App\Rules\ValidFilename;
use App\Rules\ValidMimetype;
use App\Rules\ValidNumLines;
use App\Rules\ValidSemver;
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
            'name' => 'required|string|max:100',
            'description' => 'string|nullable',
            'game' => 'required',
			'version' => ['string', 'nullable', new ValidSemver, 'max:15'],
			'website' => 'string|nullable',
            'files' => 'required',
            'files.*' => [new ValidMimetype, 'max:128', new ValidNumLines, new ValidFilename],
			'expires' => 'string|nullable'
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
			'files.*.max' => 'Files may not be more than 128KB.'
		];

        return $messages;
    }
}
