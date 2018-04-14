<?php

namespace App\Rules;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class ValidatorDob implements Rule
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
        // at least 18 years old
        if (intval(date('Y', strtotime($value))) > (date("Y") - 18)) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The dob must be 18 year old';
    }
}
