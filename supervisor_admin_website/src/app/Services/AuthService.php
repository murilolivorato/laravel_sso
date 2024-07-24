<?php

namespace App\Services;
use App\Models\UserAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Illuminate\Support\Facades\Redis;
use App\Classes\Utils\DefaultResponse;

class AuthService
{
    protected $http_host;
    protected $request_host;
    protected $client_id;
    protected $client_secret;

    protected $scope;

    protected $header =  [
        'Accept' => 'application/json'
    ];


    public function __construct(DefaultResponse $defaultResponse)
    {
        $this->defaultResponse = $defaultResponse;
        $this->http_host = config('services.auth.http_host');
        $this->request_host = config('services.auth.request_host');
        $this->client_id = config('services.auth.client_id');
        $this->client_secret = config('services.auth.client_secret');
        $this->scope = config('services.auth.scope');
        $this->callback_url = config('app.url').'/api/callback';

    }

    /**
     * @param $token
     * @return $this
     */
    public function setHeader ($token = null) {
        $this->header = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '. $token,
        ];
        return $this;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAuthLink()
    {
        $state = Str::random(40);
        $query = http_build_query([
            'client_id' => $this->client_id,
            'redirect_url' => $this->callback_url,
            'response_type' => 'code',
            'scope' => $this->scope,
            'state' => $state,
        ]);

        return response()->json(['authorize_url' => config('services.auth.http_host').'/oauth/authorize?'.$query, 'state' => $state], 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function testConnection()
    {
        $http = Http::acceptJson();
        $response = $http->get($this->request_host .'/api/get-api');
        return $this->defaultResponse->response($response);
    }

    /**
     * @param array $params
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAuthCallBack(array $params = [])
    {
        // GET THE TOKEN FROM AUTH SERVICE
        $sso_token = $this->getAuthToken($params['state'], $params['code']);
        // MAKE A NEW REQUEST IN AUTH SERVICE , AFTER THAT , IF IS AUTHORIZED , REGISTER THIS NEW USER IN THIS SERVER
        $user = $this->getUserDetaleAndRegisterNewUser($sso_token);
        // STORE TOKEN IF YOU GOIN TO ACESS AUTH USER INFORMATION IN THE FUTURE
        if ($user) {
            Redis::hmset('auth_token', $user->id, $sso_token);
        }

        if (!$user) {
            return response()->json(['status' => 'not-authorized'], 400);
        }
        // CREATE THE TOKEN, AND GIVE THE USER A ACCESS TO THIS AREA
        return $user->createToken('Supervisor')->accessToken;
    }

    /**
     * @param $state
     * @param $code
     * @return mixed
     * @throws \Throwable
     */
    private function getAuthToken($state, $code)
    {
        throw_unless(strlen($state) > 0 && $state, InvalidArgumentException::class);

        $response = Http::asForm()->post(
            $this->request_host.'/oauth/token',
            [
                'grant_type' => 'authorization_code',
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
                'redirect_url' => $this->callback_url,
                'code' => $code,
            ]);
        return $response->json()['access_token'];
    }

    /**
     * @param $access_token
     * @param $area
     * @return array|mixed
     */
    private  function getUserDetaleAndRegisterNewUser($access_token, $area = 'supervisor')
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->withToken($access_token)->get($this->request_host.'/api/user?area='.$area);
        $userData = $response->json();

        $userAdmin = UserAdmin::updateOrCreate(
            ["email" => $userData['email']],
            [
                'status' => 'active',
                'email' => $userData['email']
            ]);

        $action = $userAdmin->AdminInfo()->exists() ? 'update' : 'create';
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
