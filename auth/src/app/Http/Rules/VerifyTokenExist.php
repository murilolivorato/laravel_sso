<?php


namespace App\Http\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\UserAdminPasswordReset;

class VerifyTokenExist implements Rule
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

        // find user forgot pass table
        $userHasToken = UserAdminPasswordReset::where('token', $value )->first();

        if(!$userHasToken) {
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
        return 'Token Inválido . Tente Novamente .';
    }
}
