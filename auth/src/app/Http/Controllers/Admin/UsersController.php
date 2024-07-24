<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Access\ProcessSave;
use App\Classes\Access\ListData;
use App\Classes\Helper\TestData;
use App\Http\Controllers\Controller;
use App\Models\UserAdmin;
use App\Models\UserAdminAccessArea;
use Illuminate\Http\Request;
use App\Classes\Access\LoadOptions;
use App\Classes\Access\ProcessDestroy;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveUserAdminRequest;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $area = $request['area'];
        $accessArea = UserAdminAccessArea::where('url_title', $area)->first();
        if($accessArea) {
            return ListData::load($request, $accessArea);
        }
    }
}
