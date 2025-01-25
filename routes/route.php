<?php
use App\Controllers\HomeController;
use App\Controllers\UserController;
use Support\Route;
use Support\View;
use Support\AuthMiddleware; //<-- Penambahan Middleware atau session login

// handleMiddleware();
Route::get('/',[HomeController::class,'dashboard']);
Route::get('/login', function(){
    return view('auth/login');
});
Route::get('/getusers',[UserController::class,'getUser']);
Route::get('/users',[UserController::class,'index']);
Route::post('/users',[UserController::class,'create']);
