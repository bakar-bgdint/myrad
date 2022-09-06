<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes(['verify' => true]);

//
Route::middleware(['auth','verified'])->group(function(){
    Route::get('/dashboard',[AuthController::class,'dashboardView']);
});



Route::get('/', [AuthController::class,'loginView']);
Route::get('/login', [AuthController::class, 'loginView']);
Route::post('/login', [AuthController::class, 'login']);


Route::get('auth/facebook', [AuthController::class, 'redirectToFacebook']);

Route::get('auth/facebook/callback', [AuthController::class, 'facebookSignin']);

Route::get('/register', [AuthController::class,'registerView']);
Route::post('/register', [AuthController::class,'register']);

Route::get('/forgetpwd', [AuthController::class,'forgetPwdView']);
Route::post('/forget', [AuthController::class,'forgetPwd']);



Route::get('/resetPassword/{token}',[AuthController::class,'changePwdView']);
Route::post('/changepwd',[AuthController::class,'changePwd']);

Route::get('/verifyEmail/{token}',[AuthController::class,'emailVerify']);
