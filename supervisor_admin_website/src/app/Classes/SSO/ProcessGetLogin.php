<?php

namespace App\Classes\SSO;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProcessGetLogin
{

    public static function process(){
        try {
            return   (new static)->handle();
        } catch (ClientException $e) {
            return response()->json(['message' => 'Houve um erro , contate o suporte'], 400);
        }
    }

    private function handle(){
        return   $this->getLink();
    }

    /* CREATE IMAGE  */
    public function getLink()
    {
        $state = Str::random(40);
        $query = http_build_query([
            'client_id' => config('services.auth.client_id'),
            'redirect_url' => config('app.url_front').'/callback',
            'response_type' => 'code',
            'scope' => config('auth.sso_scope'),
            'state' => $state,
        ]);

        return response()->json(['authorize_url' => config('services.auth.http_host').'/oauth/authorize?'.$query, 'state' => $state], 200);
    }
}
