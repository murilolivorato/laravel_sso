<?php

namespace App\Http\Rules\Admin;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class VerifyUserPassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
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
        if (! Hash::check($value , $this->user->password)){
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
        return 'A Senha Não Confere com a Senha Antiga';
    }
}
