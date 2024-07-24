<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{

    use AuthorizesRequests, ValidatesRequests;
    protected $user;


    /**
     *
     */
    public function __construct()
    {

          $this->middleware(function ($request, $next) {
            $this->user   = Auth::user();
            return $next($request);
        });
    }
}
