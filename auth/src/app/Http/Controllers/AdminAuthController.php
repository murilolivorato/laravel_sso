<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Auth;
use App\Models\UserAdmin;
use App\Classes\Auth\VerifyUserPassword;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AuthApiRequest;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    use ApiResponse;

    public function postLoginTest(AuthApiRequest $request)
    {
        $user = UserAdmin::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $user->tokens()->delete();
        $token = $user->createToken($request->device_name)->accessToken;
        return response()->json(['token' => $token]);
    }


   public function postLogin(AuthApiRequest $request){
       $user = UserAdmin::where('email', $request->email)->first();
       if (! $user || ! Hash::check($request->password, $user->password)) {
           throw ValidationException::withMessages([
               'email' => ['The provided credentials are incorrect.'],
           ]);
       }
        return VerifyUserPassword::process($request , 'access-supervisor-area');
    }

    public static function getEmail($email){
        // RETURN EMAIL
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $email;
        }
        // GET EMAIL FROM CPF
        $user = UserAdmin::select([ 'id',  'status',  'email'])->with(['AdminInfo' => function ($query) {
            $query->select('cpf',  'user_id');
        }])->where('email', $email)->first();
        if(!$user){
            return;
        }
        return $user->email;
   }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function info(Request $request){
        try {
            $user = auth()->user();

            $user_admin = UserAdmin::find($user->id);

            return $this->successResponse([
                'email' => $user->email,
                'name' => isset($user_admin->AdminInfo->name) ? $user_admin->AdminInfo->name : null,
                'last_name' => isset($user_admin->AdminInfo->last_name) ? $user_admin->AdminInfo->last_name : null,
                'areas' => $user_admin->AdminInfo->AcessAreas
            ]);
        } catch (ClientException $e) {
            return $this->errorResponse([ 'não carregoru informações do usuário' ]);
            //return response()->json(['message'  =>   'não carregoru informações do usuário' ] , 400);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function userInfo(Request $request){
        try {
            $area = $request['area'];
            $user_admin = UserAdmin::find($request->user()->id);

            // VERIFY AREAÁ
            if(!$area) {
                return $this->errorResponse([ 'nao foi selecionado a area' ]);
            }

            if(!$user_admin->AcessAreas->contains('url_title', $area)) {
                return $this->errorResponse([ 'não carregoru informações do usuário' ]);
            }

            return $this->successResponse([
                'email'      => $user_admin->email,
                'name'       => isset($user_admin->AdminInfo->name) ? $user_admin->AdminInfo->name : null,
                'last_name'  => isset($user_admin->AdminInfo->last_name) ? $user_admin->AdminInfo->last_name : null,
                'cpf'        => isset($user_admin->AdminInfo->cpf) ? $user_admin->AdminInfo->cpf : null,
                'phone'      => isset($user_admin->AdminInfo->phone) ? $user_admin->AdminInfo->phone : null,
                'manager_status' => $user_admin->ManagerAreas->contains('url_title', $area) ? "is_manager" : "not_manager"
            ]);
        } catch (ClientException $e) {
            return $this->errorResponse([ 'não carregoru informações do usuário' ]);
        }
    }


    public function getApi() {
        return $this->successResponse(['connection is OK']);
    }

}
