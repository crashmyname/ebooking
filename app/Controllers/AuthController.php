<?php

namespace App\Controllers;

use App\Models\LoginAct;
use App\Models\User;
use Support\Auth;
use Support\BaseController;
use Support\Date;
use Support\Request;
use Support\Session;
use Support\Validator;
use Support\View;
use Support\CSRFToken;

class AuthController extends BaseController
{
    // Controller logic here
    public function index()
    {
        return view('auth/login');
    }

    public function onLogin(Request $request)
    {
        $credentials = [
            'identifier' => $request->username,
            'password' => $request->password,
        ];
        if (Auth::attempt($credentials)) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? 'Unknown IP';
            $hostname = gethostbyaddr($ip);
            $cekuser = User::query()->where('username','=', $request->username)->first();
            $user = User::query()->where('users_id','=',$cekuser->users_id)->first();
            $user->flag = 1;
            $user->save();
            LoginAct::create([
                'users_id' => $cekuser->users_id,
                'login_time' => Date::Now(),
                'ip_address' => $ip,
                'hostname' => $hostname,
                'status' => 'login',
            ]);
            return redirect('/home');
        }
        Session::flash('failed', 'Username atau Password Salah');
        return view('auth/login');
    }

    public function logout(Request $request)
    {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? 'Unknown IP';
        $hostname = gethostbyaddr($ip);
        $user = User::query()->where('users_id','=',Session::user()->users_id)->first();
        $user->flag = 0;
        $user->save();
        LoginAct::create([
            'users_id' => Session::user()->users_id,
            'login_time' => Date::Now(),
            'ip_address' => $ip,
            'hostname' => $hostname,
            'status' => 'logout',
        ]);
        Session::destroy();
        return redirect('/login');
    }
}
