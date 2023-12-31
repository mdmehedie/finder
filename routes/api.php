<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\PostController;

Route::get('/users',[AuthController::class,'users']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/resetpassword',[ResetPasswordController::class,'send_email_with_reset_password']);
Route::post('/reset-password/{token}', [PasswordResetController::class, 'reset']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout',[AuthController::class,'logout']);
    Route::get('/logged_user',[AuthController::class,'logged_user']);
    Route::post('/change_password',[AuthController::class,'change_password_with_old']);

    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/{post}', [PostController::class, 'show']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::put('/posts/{post}', [PostController::class, 'update']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'admin'], function () {

});
