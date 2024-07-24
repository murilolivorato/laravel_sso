<?php

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\UserInfoController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/test-api', [SiteController::class, 'testApi']);
// TEST CONNECTION
Route::get('/auth/test-connection', [AuthController::class, 'testAuthConnection']);
Route::get('/auth/test-supervisor-admin-connection', [AuthController::class, 'testSupervisorConnection']);
// AUTH
Route::get('/auth/get-login-link', [AuthController::class, 'getLoginLink']);
Route::get('/auth/callback', [AuthController::class, 'getCallBack']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('admin/auth/logout', [AuthController::class, 'logout']);
    Route::get('admin/users', [UsersController::class, 'list']);
    Route::get('admin/user-info', [UsersController::class, 'listInfo']);
});
