<?php

namespace App\Controllers;

use App\Models\Booking;
use Support\BaseController;
use Support\DataTables;
use Support\Date;
use Support\Request;
use Support\Response;
use Support\Validator;
use Support\View;
use Support\CSRFToken;

class BookingController extends BaseController
{
    // Controller logic here
    public function getBooking(Request $request)
    {
        if (Request::isAjax()) {
            $booking = Booking::query()->get();
            return DataTables::of($booking)->make(true);
        }
    }
    public function index(Request $request)
    {
        return view('booking/booking',['title' => 'booking'],'layout/app');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_lapangan' => 'required|min:4|unique:lapangan',
            'harga' => 'required|min:3',
        ]);
        if($validator){
            return Response::json(['status'=>$validator]);
        }
        $booking = Booking::create([
            'nama_lapangan' => $request->nama_lapangan,
            'harga' => $request->harga,
            'created_at' => Date::Now(),
            'updated_at' => Date::Now(),
        ]);
        if($booking){
            return Response::json(['status'=>201,'message'=>'Lapangan berhasil ditambahkan']);
        }
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(),[
            'nama_lapangan' => 'required|min:4|unique:lapangan',
            'harga' => 'required|min:3',
        ]);
        if($validator){
            return Response::json(['status'=>$validator]);
        }
        $booking = Booking::query()->where('lapangan_id',$id)->first();
        $booking->nama_lapangan = $request->nama_lapangan;
        $booking->harga = $request->harga;
        $booking->updated_at = Date::Now();
        $booking->save();
        if($booking){
            return Response::json(['status'=>200,'message'=>'Lapangan berhasil diupdate']);
        }
    }

    public function delete(Request $request,$id)
    {
        $booking = Booking::query()->where('lapangan_id',$id)->first();
        $booking->delete();
        if($booking){
            return Response::json(['status'=>200,'message'=>'Lapangan berhasil dihapus']);
        }
    }
}
