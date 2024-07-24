<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Rules\ValidateEmailExist;

class SendLinkResetPassRequest extends FormRequest
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
            'email_cpf'                 => ['required' , new ValidateEmailExist  ]
        ];

    }
}
