<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Classes\Auth\LoadFormPasswordReset;
use App\Classes\Auth\ProcessRecoverPassword;
use App\Classes\Auth\ProcessSendLinkResetPassword;
use Illuminate\Http\Request;
use App\Http\Requests\ChangeUserPasswordRequest;
use App\Http\Requests\SendLinkResetPassRequest;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    public function index(Request $request) {
        $status = $request['status'];
        $user_email = $request->session()->has('user_email') ? $request->session()->get('user_email') : null ;
        return view('forgot_password', ['status' => $status, 'user_email' => $user_email]);
    }

    /**
     * @param SendLinkResetPassRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postResetPass(SendLinkResetPassRequest $request){
        return ProcessSendLinkResetPassword::process($request);
    }


    public function recoverPassword(Request $request, $token){
        $data = LoadFormPasswordReset::process($token);
        return view('recover_password', ['data'  => $data,
            'token' => $token ]);
    }

    public function recoveredPassword() {
        return view('recovered_password');
    }
    /**
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    /*public function loadFormPasswordReset($token)
    {
        return LoadFormPasswordReset::process($token);
    }*/


    /**
     * @param ChangeUserPasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postRecoverPass(ChangeUserPasswordRequest $request){
        return ProcessRecoverPassword::process($request);

    }
}
