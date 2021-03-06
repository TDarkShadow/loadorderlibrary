<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidFilename implements Rule
{

	protected $validFilenames = [
		'modlist.txt',
		'plugins.txt',
		'loadorder.txt',
		'Skyrim.ini',
		'SkyrimPrefs.ini',
		'morrowind.ini',
		'MGE.ini',
		''
	];

	protected $file = '';

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
		$this->file = $value->getClientOriginalName();

        return in_array($this->file, $this->validFilenames);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->file . ' is not named correctly. Please double check valid filenames on the right and try again.';
    }
}
