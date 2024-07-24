<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\UserAdmin;
use App\Services\AuthUserService;
use App\Services\AuthService;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;
use function Pest\Laravel\json;

class UsersController extends Controller
{
    public function list(Request $request)
    {
        $users = UserAdmin::select('id','email')->with('AdminInfo')->get();
         return response()->json(['data' => $users]);
    }

    public function listInfo(Request $request)
    {
        try {
            $user_admin = UserAdmin::find($this->user->id);

            return response()->json([
                'email' => $user_admin->email,
                'name' => isset($user_admin->AdminInfo->name) ? $user_admin->AdminInfo->name : null,
                'last_name' => isset($user_admin->AdminInfo->last_name) ? $user_admin->AdminInfo->last_name : null,
                'is_manager' => $user_admin->AdminInfo->manager_status === 'is_manager' ? true : false,
            ]);
        } catch (ClientException $e) {
            return response()->json(['message' => 'It didnt load the user'], 400);
        }
    }
}
