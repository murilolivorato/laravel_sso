<?php

namespace App\Classes\SSO;

use App\Classes\Helper\TestData;
use App\Models\UserAdmin;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use InvalidArgumentException;
class ProcessCallBack
{
    protected $request;
    protected $sso_token;

    public static function process(Request $request){
        try {
            return   (new static)->handle($request);
        } catch (ClientException $e) {
            return response()->json(['message' => 'Houve um erro , contate o suporte'], 400);
        }
    }

    private function handle(Request $request) {
        return   $this->setRequest($request)
                      ->setSSOToken()
                      ->getAreaToken();
    }

    // REQUEST
    private function setRequest(Request $request){
        $this->request = $request ;
        return $this;
    }

    /* CREATE IMAGE  */
    private function setSSOToken()
    {
        $this->sso_token = self::getAuthToken($this->request['state'], $this->request['code']);
        return $this;

    }

    private function getAreaToken() {

        $user = self::getUserDetale($this->sso_token);
        // STORE TOKEN
        if ($user) {
            $user->auth_token = $this->sso_token;
            $user->save();
            // Redis::hmset('auth_token', $user->id, $access_token);
        }

        if (! $user) {
            return response()->json(['status' => 'nao-autorizado'], 400);
        }

        return $user->createToken('Supervisor')->accessToken;
    }

    private function getAuthToken($state, $code)
    {
        throw_unless(strlen($state) > 0 && $state, InvalidArgumentException::class);

        $response = Http::asForm()->post(
            config('services.auth.request_host').'/oauth/token',
            [
                'grant_type' => 'authorization_code',
                'client_id' => config('services.auth.client_id'),
                'client_secret' => config('services.auth.client_secret'),
                'redirect_url' => config('services.auth.http_host').'/callback',
                'code' => $code,
            ]);

        return $response->json()['access_token'];
    }

    private static function getUserDetale($access_token, $area = 'supervisor')
    {
        /* TestData::printtxt(["Accept" => "application/json",
             "Authorization" => "Bearer " . $access_token]);
        */
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->withToken($access_token)->get(config('services.auth.request_host').'/api/user?area='.$area);
        $userData = $response->json();
        /*$user = UserAdmin::where('email', $email)->first();*/

        $userAdmin = UserAdmin::updateOrCreate(
        ["email" => $userData['email']],
        [
            'status' => 'active',
            'email' => $userData['email']
        ]);

        $action = $userAdmin->AdminInfo->exists() ? 'update' : 'create';
        $userAdmin->AdminInfo()->{$action}([
            'name' => $userData['name'],
            'last_name' => $userData['last_name'],
            'cpf' => $userData['cpf'],
            'phone' => $userData['phone'],
            'manager_status' => $userData['manager_status'],
        ]);

        return $userAdmin;
    }
}
