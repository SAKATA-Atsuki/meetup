<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AuthCode implements Rule
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
        if (Auth::guard('freshman')->check()) {
            if ($value == Auth::guard('freshman')->user()->auth_code) {
                return true;
            }    
        }
        if (Auth::guard('circle')->check()) {
            if ($value == Auth::guard('circle')->user()->auth_code) {
                return true;
            }    
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '※認証コードが正しくありません';
    }
}
