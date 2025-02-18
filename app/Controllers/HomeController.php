<?php

namespace App\Controllers;

use App\Models\Booking;
use App\Models\Lapangan;
use App\Models\LoginAct;
use App\Models\User;
use Support\BaseController;
use Support\Date;
use Support\Request;
use Support\Validator;
use Support\View;
use Support\CSRFToken;

class HomeController extends BaseController
{
    // Controller logic here
    public function Day(Request $request)
    {
        $day = Date::DayName();
        switch(true){
            case $day == 'Monday':
                $hari = 'Senin';
                break;
            case $day == 'Tuesday':
                $hari = 'Selasa';
                break;
            case $day == 'Wednesday':
                $hari = 'Rabu';
                break;
            case $day == 'Thursday':
                $hari = 'Kamis';
                break;
            case $day == 'Friday':
                $hari = 'Jumat';
                break;
            case $day == 'Saturday':
                $hari = 'Sabtu';
                break;
            case $day == 'Sunday':
                $hari = 'Minggu';
                break;
            default:
                $hari = 'Hari tidak ditemukan';
        }
        return $hari;
    }

    public function dashboard(Request $request)
    {
        $title = 'Dashboard';
        $hari = $this->Day($request);
        $user = User::query()->count();
        $sport = Lapangan::query()->count();
        $bookingtoday = Booking::query()->where('booking_date','=',Date::Now())->count();
        $onlineuser = User::query()->where('flag','=',1)->count();
        return view('home/home',['title' => $title,'hari'=>$hari,'user'=>$user,'sport'=>$sport,'booking'=>$bookingtoday,'online'=>$onlineuser],'layout/app');
    }
}
