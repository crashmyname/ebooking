<?php
use App\Controllers\ApiController;
use App\Controllers\AuthController;
use App\Controllers\BookingController;
use App\Controllers\HomeController;
use App\Controllers\LapanganController;
use App\Controllers\ScheduleController;
use App\Controllers\StatusController;
use App\Controllers\UserController;
use App\Models\Booking;
use Support\Response;
use Support\Route;
use Support\View;
use Support\AuthMiddleware; //<-- Penambahan Middleware atau session login

// handleMiddleware();
Route::get('/',[AuthController::class,'index']);
Route::get('/login', function(){
    return view('auth/login');
});
Route::post('/login',[AuthController::class,'onLogin']);
Route::get('/testbooking',[BookingController::class, 'getcalenderData']);
Route::get('/cardbooking/{id}',[BookingController::class, 'generateCard']);
Route::get('/card/{id}', [BookingController::class, 'cardBooking']);
Route::group([AuthMiddleware::class],function(){
    // Options
    Route::post('/testlo',[ApiController::class,'DataApiNama']);
    Route::post('/getscheduledata',[BookingController::class,'getScheduleData']);
    Route::post('/getday',[BookingController::class,'getDay']);
    Route::post('/logout',[AuthController::class,'logout']);
    Route::get('/profile',[HomeController::class,'profile']);
    Route::get('/settings',[HomeController::class,'settings']);
    Route::get('/home',[HomeController::class,'dashboard']);
    // Users
    Route::get('/getusers',[UserController::class,'getUser']);
    Route::get('/users',[UserController::class,'index']);
    Route::post('/users',[UserController::class,'create']);
    Route::put('/uusers/{id}',[UserController::class,'update']);
    Route::delete('/users/{id}',[UserController::class,'delete']);
    Route::get('/user/profile/{id}',[UserController::class, 'profile']);
    Route::post('/user/profile/{id}',[UserController::class, 'updateProfile']);
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
    Route::get('/mapschedule',[ScheduleController::class, 'getScheduleUser']);
    // Booking
    Route::get('/getbooking',[BookingController::class,'getBooking']);
    Route::get('/booking',[BookingController::class,'index']);
    Route::post('/booking',[BookingController::class,'create']);
    Route::put('/booking/{id}',[BookingController::class,'update']);
    Route::delete('/booking/{id}/{uid}',[BookingController::class,'delete']);
    Route::get('/report', function(){
        return view('report/report',[],'layout/app');
    });
    // Status
    Route::get('/getstatus',[StatusController::class, 'getStatus']);
    Route::get('/status',[StatusController::class, 'index']);
    Route::post('/status',[StatusController::class, 'create']);
    Route::put('/status/{id}',[StatusController::class, 'update']);
    Route::delete('/status/{id}',[StatusController::class, 'delete']);
});