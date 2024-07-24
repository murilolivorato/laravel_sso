<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Rules\Admin\VerifyUserPassword;
use Illuminate\Support\Facades\Auth;

class UpdatePasswordRequest extends FormRequest
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
            'old_password'              =>  ['required' , new VerifyUserPassword(Auth::user()) ],
            'password'                  => 'required|min:6|max:32',
            'password_confirmation'     => 'required|same:password',
        ];

    }
}
