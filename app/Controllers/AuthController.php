<?php

namespace App\Controllers;

use Support\Auth;
use Support\BaseController;
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
            return redirect('/home');
        }
        return view('auth/login');
    }

    public function logout(Request $request)
    {
        Session::destroy();
        return redirect('/login');
    }
}
