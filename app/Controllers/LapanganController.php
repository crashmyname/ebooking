<?php

namespace App\Controllers;

use App\Models\Lapangan;
use Support\BaseController;
use Support\DataTables;
use Support\Date;
use Support\Request;
use Support\Response;
use Support\Validator;
use Support\View;
use Support\CSRFToken;

class LapanganController extends BaseController
{
    // Controller logic here
    public function getLapangan(Request $request)
    {
        if (Request::isAjax()) {
            $lapangan = Lapangan::query()->get();
            return DataTables::of($lapangan)->make(true);
        }
    }
    public function index(Request $request)
    {
        return view('lapangan/lapangan',['title' => 'lapangan'],'layout/app');
    }

    public function create(Request $request)
    {
        $lapangan = Lapangan::create([
            'jenis' => $request->lapangan,
            'created_at' => Date::Now(),
            'updated_at' => Date::Now(),
        ]);
        if($lapangan){
            return Response::json(['status'=>201,'message'=>'Lapangan berhasil ditambahkan']);
        }
    }

    public function update(Request $request,$id)
    {
        $lapangan = Lapangan::query()->where('lapangan_id','=',$id)->first();
        $lapangan->jenis = $request->lapangan;
        $lapangan->updated_at = Date::Now();
        $lapangan->save();
        if($lapangan){
            return Response::json(['status'=>200,'message'=>'Lapangan berhasil diupdate']);
        }
    }

    public function delete(Request $request,$id)
    {
        $lapangan = Lapangan::query()->where('lapangan_id','=',$id)->first();
        $lapangan->delete();
        if($lapangan){
            return Response::json(['status'=>200,'message'=>'Lapangan berhasil dihapus']);
        }
    }
}
