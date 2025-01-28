<?php

namespace App\Controllers;

use App\Models\Status;
use Support\BaseController;
use Support\DataTables;
use Support\Date;
use Support\Request;
use Support\Response;
use Support\Validator;
use Support\View;
use Support\CSRFToken;

class StatusController extends BaseController
{
    // Controller logic here
    public function getStatus(Request $request)
    {
        if(Request::isAjax()){
            $status = Status::all();
            return DataTables::of($status)->make(true);
        }
    }

    public function index()
    {
        return view('status.status',['title'=>'status'],'layout.app');
    }

    public function create(Request $request)
    {
        $status = Status::create([
            'status' => $request->status,
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ]);
        if($status){
            return Response::json(['status'=>201]);
        }
    }

    public function update(Request $request, $id)
    {

    }

    public function delete(Request $request, $id)
    {
        
    }
}
