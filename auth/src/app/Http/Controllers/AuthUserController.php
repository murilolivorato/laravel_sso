<?php

namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class AuthUserController extends Controller
{
    public function postLogin(Request $request) {
        try {
            $response = Http::asForm()->post(config('services.passport.login_endpoint'), [
                'grant_type' => 'password',
                'client_id' => config('services.passport.customer_client_id'),
                'client_secret' => config('services.passport.customer_client_secret'),
                'username' => $request->email ,
                'password' => $request->password ,
                'scope' => '*',
            ]);
            return $response->json();

        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'message' => [$e->getMessage()]
            ]);
        }
    }

    public function userInfo() {
        return response()->json([
            'email'     => $this->user->email,
            'name'      => $this->user->name
        ]);
    }

    public function logout() {
        if(auth('api')->user()) {
            auth('api')->user()->tokens->each(function ($token, $key) {
                $token->delete();
            });
        }
        return response()->json(null, 200);
    }
}
