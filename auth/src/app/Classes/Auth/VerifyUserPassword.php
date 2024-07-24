<?php
namespace App\Classes\Auth;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Client;

class VerifyUserPassword {

    public static function process($request , $type_access){
        return   (new static)->handle($request , $type_access );
    }

    private function handle($request , $type_access){
        return   $this->setToken($request , $type_access);
    }


    private  function  setToken($request , $type_access){
        $http = new Guzzle;
           return  $http->post('http://laravel_auth_sso_server:80/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.password_id'),
                    'client_secret' => config('services.passport.password_secret'),
                    'username' => $request->email ,
                    'password' => $request->password ,
                    'scope'    => '*'
                ]
            ]);
    }

}
