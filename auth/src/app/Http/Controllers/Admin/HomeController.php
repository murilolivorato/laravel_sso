<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserAdmin;
use App\Models\UserAdminAccessArea;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;

/**
 *   HOME CONTROLLER
 */
class HomeController extends Controller
{
    use ApiResponse;
    public function __construct()
    {
        parent::__construct();

        // verify admin user
        $this->middleware('admin');
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $user_id = Auth::user()->id;

        $access_area = UserAdminAccessArea::select('title', 'description', 'url')
            ->whereHas('Users', function ($query) use ($user_id) {
                $query->where('id', $user_id);
            })->get();

        $user = UserAdmin::select([ 'id',  'status',  'email'])
            ->with(['AdminInfo' => function ($query) {
                $query->select('name', 'cpf', 'phone', 'last_name', 'user_id');
            }])->where('id', $user_id)->first();

        return view('admin/home', ['access_areas' => $access_area, 'user' => ['name' => $user->AdminInfo->name . " ". $user->AdminInfo->last_name, 'email' => $user->email] ]);
    }
}
