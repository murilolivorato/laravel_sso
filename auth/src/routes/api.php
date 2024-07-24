<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UsersController;
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
Route::post('/admin/post-login', [AdminAuthController::class, 'postLogin'])->name('postLoginGrandType');
Route::post('/admin/post-login-test', [AdminAuthController::class, 'postLoginTest'])->name('postLoginPersonal');

Route::get('/get-api', [SiteController::class, 'getApi']);
Route::post('/admin/logout', [LoginController::class, 'logoutAPI']);
Route::get('/logout-user', [ LoginController::class, 'getLogout']);
/* -------------------------------------------------------  REAL ESTATE LOGIN*/

Route::group(['middleware' => ['auth:api',  'scope:access-supervisor-area']] , function () {
    Route::get('/user', [AdminAuthController::class, 'userInfo']);
    Route::post('/admin/info', [AdminAuthController::class, 'info']);
    Route::get('/admin/get-user-areas', [HomeController::class, 'getUserAreas']);
    Route::get('admin/users', [UsersController::class, 'index']);
});

