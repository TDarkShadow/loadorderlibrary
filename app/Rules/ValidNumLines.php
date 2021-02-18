<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidNumLines implements Rule
{
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
        return count(explode("\n", file_get_contents($value))) >= 5;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'A file is not valid. If you believe this is wrong, contact Phin.';
    }
}
