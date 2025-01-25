<?php

namespace App\Controllers;

use App\Models\Schedule;
use Support\Date;
use Support\Response;
use Support\BaseController;
use Support\DataTables;
use Support\Request;
use Support\Validator;
use Support\View;
use Support\CSRFToken;

class ScheduleController extends BaseController
{
    // Controller logic here
    public function getSchedule(Request $request)
    {
        if (Request::isAjax()) {
            $schedule = Schedule::query()->get();
            return DataTables::of($schedule)->make(true);
        }
    }
    public function index(Request $request)
    {
        return view('schedule/schedule',['title' => 'schedule'],'layout/app');
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
        $schedule = Schedule::create([
            'nama_lapangan' => $request->nama_lapangan,
            'harga' => $request->harga,
            'created_at' => Date::Now(),
            'updated_at' => Date::Now(),
        ]);
        if($schedule){
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
        $schedule = Schedule::query()->where('lapangan_id',$id)->first();
        $schedule->nama_lapangan = $request->nama_lapangan;
        $schedule->harga = $request->harga;
        $schedule->updated_at = Date::Now();
        $schedule->save();
        if($schedule){
            return Response::json(['status'=>200,'message'=>'Lapangan berhasil diupdate']);
        }
    }

    public function delete(Request $request,$id)
    {
        $schedule = Schedule::query()->where('lapangan_id',$id)->first();
        $schedule->delete();
        if($schedule){
            return Response::json(['status'=>200,'message'=>'Lapangan berhasil dihapus']);
        }
    }
}
