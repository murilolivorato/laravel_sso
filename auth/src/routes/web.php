<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Auth\ForgotPasswordController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/*Route::get('login', [AuthUserController::class, 'frontLogin'])->name('login');

Route::get('/', function () {
    return view('welcome');
});
*/
/*Route::get('/callback', function () {
    dd("foii");
});*/

Auth::routes();
Route::get('/', [LoginController::class, 'showLoginForm']);
Route::get('/admin/home', [HomeController::class, 'index'])->name('home');
Route::get('/admin/alterar-senha', [HomeController::class, 'change_password'])->name('change_password');
Route::post('/admin/update-password', [HomeController::class, 'update_password'])->name('update_password');
Route::get('/esqueceu-a-senha'  ,[ ForgotPasswordController::class, 'index'])->name('ForgotPassView');
Route::get('/recuperar-senha/{token}', [ ForgotPasswordController::class, 'recoverPassword']);
Route::get('/recuperou-senha', [ ForgotPasswordController::class, 'recoveredPassword']);
Route::post('/password/post-reset', [ForgotPasswordController::class, 'postResetPass'])->name('postResetPass');
Route::get('/password/load-form-recover-pass/{token}', [ ForgotPasswordController::class, 'loadFormPasswordReset' ]);
Route::post('/password/post-recover', [ ForgotPasswordController::class, 'postRecoverPass' ])->name('postRecoverPass');
/*Route::get('/logout-user' , [LoginController::class, 'getLogout']);*/
