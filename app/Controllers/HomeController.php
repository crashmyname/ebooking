<?php

namespace App\Controllers;

use App\Models\Booking;
use App\Models\Lapangan;
use App\Models\LoginAct;
use App\Models\User;
use Support\BaseController;
use Support\Date;
use Support\Request;
use Support\Response;
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
        $date = Date::Now();
        $format = Date::parse($date)->format('Y-m-d');
        $user = User::query()->count();
        $sport = Lapangan::query()->count();
        $bookingtoday = Booking::query()->whereDate('booking_date',$format)->count();
        $onlineuser = User::query()->where('flag','=',1)->count();
        return view('home/home',['title' => $title,'hari'=>$hari,'user'=>$user,'sport'=>$sport,'booking'=>$bookingtoday,'online'=>$onlineuser],'layout/app');
    }

    public function monitor()
    {
        $date = Date::Now();
        $format = Date::parse($date)->format('Y-m-d');
        $booking = Booking::query()->leftJoin('schedule','booking.schedule_id','=','schedule.schedule_id')
            ->leftJoin('lapangan','schedule.lapangan_id','=','lapangan.lapangan_id')
            ->leftJoin('users','booking.users_id','=','users.users_id')
            ->whereDate('booking.booking_date',$format)
            ->get();
        return view('monitor',['booking'=>$booking]);
    }

    public function countData()
    {
        $date = Date::Now();
        $format = Date::parse($date)->format('Y-m-d');
        $user = User::query()->count();
        $sport = Lapangan::query()->count();
        $bookingtoday = Booking::query()->whereDate('booking_date',$format)->count();
        $onlineuser = User::query()->where('flag','=',1)->count();
        return Response::json(['user'=>$user,'sport'=>$sport,'booking'=>$bookingtoday,'online'=>$onlineuser]);
    }
}
