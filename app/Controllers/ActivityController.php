<?php

namespace App\Controllers;

use App\Models\LoginAct;
use Support\BaseController;
use Support\DataTables;
use Support\Request;
use Support\Validator;
use Support\View;
use Support\CSRFToken;

class ActivityController extends BaseController
{
    // Controller logic here
    public function LoginActivity(Request $request)
    {
        if(Request::isAjax()){
            $loginactivity = LoginAct::query()->leftJoin('users','login_activity.users_id','=','users.users_id')
                            ->get();
            return DataTables::of($loginactivity)
                            ->make(true);
        }
    }
    public function index()
    {
        return view('activity/loginactivity',[],'layout/app');
    }
}
