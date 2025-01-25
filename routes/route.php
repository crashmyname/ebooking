<?php
use App\Controllers\ApiController;
use App\Controllers\AuthController;
use App\Controllers\BookingController;
use App\Controllers\HomeController;
use App\Controllers\LapanganController;
use App\Controllers\ScheduleController;
use App\Controllers\UserController;
use Support\Route;
use Support\View;
use Support\AuthMiddleware; //<-- Penambahan Middleware atau session login

// handleMiddleware();
Route::get('/',[HomeController::class,'dashboard']);
Route::get('/login', function(){
    return view('auth/login');
});
Route::group([AuthMiddleware::class],function(){
    
});
Route::post('/testlo',[ApiController::class,'DataApiNama']);
Route::post('/login',[AuthController::class,'onLogin']);
Route::get('/logout',[AuthController::class,'logout']);
Route::get('/home',[HomeController::class,'dashboard']);
Route::get('/profile',[HomeController::class,'profile']);
Route::get('/settings',[HomeController::class,'settings']);
// Users
Route::get('/getusers',[UserController::class,'getUser']);
Route::get('/users',[UserController::class,'index']);
Route::post('/users',[UserController::class,'create']);
Route::put('/users/{id}',[UserController::class,'update']);
Route::delete('/users/{id}',[UserController::class,'delete']);
// Lapangan
Route::get('/getlapangan',[LapanganController::class,'getLapangan']);
Route::get('/lapangan',[LapanganController::class,'index']);
Route::post('/lapangan',[LapanganController::class,'create']);
Route::put('/lapangan/{id}',[LapanganController::class,'update']);
Route::delete('/lapangan/{id}',[LapanganController::class,'delete']);
// Schedule
Route::get('/getschedule',[ScheduleController::class,'getSchedule']);
Route::get('/schedule',[ScheduleController::class,'index']);
Route::post('/schedule',[ScheduleController::class,'create']);
Route::put('/schedule/{id}',[ScheduleController::class,'update']);
Route::delete('/schedule/{id}',[ScheduleController::class,'delete']);
// Booking
Route::get('/getbooking',[BookingController::class,'getBooking']);
Route::get('/booking',[BookingController::class,'index']);
Route::post('/booking',[BookingController::class,'create']);
Route::put('/booking/{id}',[BookingController::class,'update']);
Route::delete('/booking/{id}',[BookingController::class,'delete']);