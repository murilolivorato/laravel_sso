<?php

namespace App\Http\Rules;

use App\Models\UserAdmin;
use App\Classes\Helper\SetCharacter;
use Illuminate\Contracts\Validation\Rule;

class ValidateEmailExist implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $type;
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
        $this->type = str_contains($value, '@') ? 'email' : 'cpf';
        $email = self::getEmail($value);
        $user = UserAdmin::where('email' , $email)->first();
        if($user){
            return true;
        }

        return false;
    }

    public static function getEmail($userName){
        // RETURN EMAIL
        if(filter_var($userName, FILTER_VALIDATE_EMAIL)) {
            return SetCharacter::makeLowercase($userName);
        }
        // GET EMAIL FROM CPF
        $cpf = preg_replace("/[^0-9]/", "", $userName );
        $user = UserAdmin::select([ 'id',  'status',  'email'])->with(['AdminInfo' => function ($query) {
            $query->select('cpf',  'user_id');
        }])->when($cpf, function ($query) use ($cpf) {
            $query->WhereHas('AdminInfo' , function($query)  use ($cpf) {
                return $query->where('cpf' ,'like',  '%' .  $cpf .'%'  );
            });
        })->first();
        if(!$user){
            return;
        }
        return $user->email;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if($this->type == 'email') {
            return 'E-mail não encontrado em nosso cadastro. Tente informar o CPF ou entre em contato com seu gestor.';
        }
        return 'CPF não encontrado: CPF não cadastrado em nossa base. Informe seu Gestor.';

    }
}
