<?php

namespace App\Http\Requests;

use App\Classes\Enums\StatusEnum;
use App\Models\UserAdmin;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Http\Rules\Cpf;
class SaveUserAdminRequest extends FormRequest
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

    protected function prepareForValidation(): void
    {
        if (!array_key_exists('admin_info', $this->request->all())) {
            return;
        }
        $this->merge(
            [
            'admin_info' => [
                'name' => $this->admin_info['name'],
                'last_name' => $this->admin_info['last_name'],
                'cpf' => preg_replace('/[^0-9]/', "", $this->admin_info['cpf']),
                'phone' => preg_replace('/[^0-9]/', "", $this->admin_info['phone'])
             ]
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'password' => 'required|max:12',
           'folder' => 'required|max:191',
           'email' => ['required', 'string', 'email', 'max:255', 'unique:'.UserAdmin::class],
           'status' => [new Enum(StatusEnum::class)],
           'admin_info.name' => 'required|max:191',
           'admin_info.cpf' =>  ['required', 'string', 'max:11', new Cpf],
           'admin_info.phone' => 'required|max:191',
           'admin_info.last_name' => 'required|max:191',
           'role_id' => 'required|exists:user_admin_roles,id',
           'area_id' => 'required|exists:user_admin_access_areas,id',
           'image_profile.*' => 'required|mimes:jpg,jpeg,png,bmp,tiff|max:10000'
            ];
    }

}
