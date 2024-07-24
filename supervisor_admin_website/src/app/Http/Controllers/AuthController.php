<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Services\AuthService;
use Illuminate\Support\Facades\Redis;

class AuthController extends Controller
{
    protected $authService;

    protected $user;
    protected $auth_access_token = null;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
        $this->middleware(function ($request, $next) {
            $this->user   = Auth::user();
            $this->auth_access_token = $this->user && Redis::hexists("auth_token", $this->user->id) ? Redis::hget("auth_token", $this->user->id) : null;
            return $next($request);
        });
    }
    // connect to sso
    public function testAuthConnection()
    {
        return $this->authService->testConnection();
    }

    // connect to this project
    public function testSupervisorConnection()
    {
        $http = Http::acceptJson();
        $response = $http->get(config('app.app_server_url').'/api/test-api');
        return $response->json();
    }

    /**
     * GET LOGIN
     * GERATE THE LINK WITH AUTHORIZE_URL AND STATE
     * LIKE THIS ONE -
     * http://localhost:8081/oauth/authorize?client_id=9c93bc86-7f11-4c1c-83ee-9ceb590b4e6f&redirect_url=http%3A%2F%2Flocalhost%3A8082%2Fapi%2Fcallback&response_type=code&scope=access-supervisor-area&state=dZMx2HgbMydYEeqQ6EvTFoH7TPI5l1dMQWnVvl8X
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getLoginLink()
    {
        return $this->authService->getAuthLink();
    }

    /**
     * AFTE LOGGIN ON AUTH SERVICE IT WILL BE REDIRECT TO HERE
     * IT WILL RETURN A STATE AND CODE
     * WITH THAT WILL BE POSSIBLE TO GET THE TOKEN MAKING A NEW REQUEST TO AUTH SERVICE AT - /oauth/token
     * WITH THIS TOKEN , IT WILL BE POSSIBLE TO CERATE A NEW USER
     * AND GET A NEW SUPERISOR SERVICE TOKEN
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * @throws \Throwable
     */
    public function getCallBack(Request $request)
    {
        return $this->authService->getAuthCallBack($request->all());
    }

    public function logout(Request $request)
    {

        if(auth()->user()) {
            auth()->user()->tokens->each(function ($token, $key) {
                $token->delete();
            });
        }
        return response()->json('Logged out successfully', 200);

    }


}
