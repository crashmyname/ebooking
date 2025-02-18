<?php

namespace App\Controllers;

use App\Models\LoginAct;
use Support\BaseController;
use Support\DataTables;
use Support\Date;
use Support\Request;
use Support\Validator;
use Support\View;
use Support\CSRFToken;

class ActivityController extends BaseController
{
    // Controller logic here
    public function LoginActivity(Request $request)
    {
        $sdate = Date::parse($request->start_date)->startOfDay();
        $edate = Date::parse($request->end_date)->endOfDay();
        if(Request::isAjax()){
            if($request->start_date == null || $request->end_date == null){
                return DataTables::of([])
                                ->make(true);
            } else {
                $loginactivity = LoginAct::query()->leftJoin('users','login_activity.users_id','=','users.users_id')
                                ->whereBetween('login_activity.login_time',$sdate,$edate)
                                ->get();
                return DataTables::of($loginactivity)
                                ->make(true);
            }
        } else {
            return DataTables::of([])
                            ->make(true);
        }
    }
    public function index()
    {
        return view('activity/loginactivity',[],'layout/app');
    }
}
