<?php

namespace App\Http\Requests;

use App\Rules\ValidFilename;
use App\Rules\ValidMimetype;
use App\Rules\ValidNumLines;
use App\Rules\ValidSemver;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLoadOrder extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
			'name' => 'required|string|max:100',
			'description' => 'string|nullable',
			'game' => 'required',
			'version' => ['string', 'nullable', new ValidSemver, 'max:15'],
			'website' => 'string',
			'files.*' => [new ValidMimetype, 'max:128', new ValidNumLines, new ValidFilename],
			'existing' => 'required',
			'existing.*' => 'string'
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
			'files.*.max' => 'Files may not be more than 128KB.',
			'files.*.mimes' => 'Files must be of type txt or ini',
			'existing' => 'At least one file is required for a list'
		];
	}
}
