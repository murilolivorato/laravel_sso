<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Rules\VerifyTokenExist;

class ChangeUserPasswordRequest extends FormRequest
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

        $this->redirect = url()->previous();
        return [
            'password'                  => 'required|min:6|max:32',
            'password_confirmation'     => 'required|same:password',
            'token'                     => new VerifyTokenExist
        ];

    }
}
