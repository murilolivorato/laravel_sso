<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $user;

    protected $area = 'supervisor';

    public function __construct()
    {

        if (Auth::guard('api')->check()) {
            $this->user = auth('api')->user();
        }
        /*$this->middleware(function ($request, $next) {
            $this->user = auth('api')->user();

            return $next($request);
        });*/
    }
}
