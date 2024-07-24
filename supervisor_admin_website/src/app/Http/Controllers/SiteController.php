<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class SiteController extends Controller
{
    public function testApi(Request $request)
    {
        return response()->json(['data' => 'test ok'], 200);
    }
}
