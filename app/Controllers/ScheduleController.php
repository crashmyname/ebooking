<?php

namespace App\Controllers;

use App\Models\Lapangan;
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
            $schedule = Schedule::query()->leftJoin('lapangan','lapangan.lapangan_id','=','schedule.lapangan_id')->get();
            return DataTables::of($schedule)->make(true);
        }
    }
    public function index(Request $request)
    {
        $lapangan = Lapangan::all();
        return view('schedule/schedule',['title' => 'schedule','lapangan'=>$lapangan],'layout/app');
    }

    public function getScheduleUser()
    {
        $schedules = Schedule::query()
        ->leftJoin('lapangan', 'lapangan.lapangan_id', '=', 'schedule.lapangan_id')
        ->select('schedule.*','lapangan.jenis') 
        ->orderBy('lapangan.jenis')
        ->orderBy('schedule.session')
        ->get();

    // Mengelompokkan data berdasarkan jenis olahraga
        $groupedSchedules = [];
        foreach ($schedules as $sch) {
            $groupedSchedules[$sch->jenis][$sch->start_time . ' - ' . $sch->end_time][$sch->day] = $sch->start_time . ' - ' . $sch->end_time;
        }
        return view('schedule/mapschedule',['groupedSchedules'=>$groupedSchedules],'layout/app');
    }

    public function create(Request $request)
    {
        $schedule = Schedule::create([
            'lapangan_id' => $request->lapangan_id,
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'session' => $request->session,
            'created_at' => Date::Now(),
            'updated_at' => Date::Now(),
        ]);
        if($schedule){
            return Response::json(['status'=>201,'message'=>'Lapangan berhasil ditambahkan']);
        }
    }

    public function update(Request $request,$id)
    {
        $schedule = Schedule::query()->where('schedule_id','=',$id)->first();
        $schedule->lapangan_id = $request->lapangan_id;
        $schedule->day = $request->day;
        $schedule->start_time = $request->start_time;
        $schedule->end_time = $request->end_time;
        $schedule->session = $request->session;
        $schedule->updated_at = Date::Now();
        $schedule->save();
        if($schedule){
            return Response::json(['status'=>200,'message'=>'Lapangan berhasil diupdate']);
        }
    }

    public function delete(Request $request,$id)
    {
        $schedule = Schedule::query()->where('schedule_id','=',$id)->first();
        $schedule->delete();
        if($schedule){
            return Response::json(['status'=>200,'message'=>'Lapangan berhasil dihapus']);
        }
    }
}
