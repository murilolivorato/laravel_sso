<?php

namespace App\Http\Controllers;

class SiteController extends Controller
{
    public function getApi () {
        return response()->json(['test connection auth']);
    }
}
