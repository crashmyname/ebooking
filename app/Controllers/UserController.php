<?php

namespace App\Controllers;

use App\Models\Role;
use App\Models\User;
use Support\BaseController;
use Support\DataTables;
use Support\Date;
use Support\Request;
use Support\Response;
use Support\Session;
use Support\UUID;
use Support\Validator;
use Support\View;
use Support\CSRFToken;

class UserController extends BaseController
{
    // Controller logic here
    public function getUser(Request $request)
    {
        if (Request::isAjax()) {
            $user = User::query()->leftJoin('role','role.role_id','=','users.role_id')->get();
            return DataTables::of($user)->make(true);
        }
    }
    public function index(Request $request)
    {
        if(Session::user()->role_id != 1){
            View::error('errors/403');
            return;
        }
        $role = Role::all();
        return view('users/user',['title' => 'Users','role'=>$role],'layout/app');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'username' => 'required|min:4|unique:users',
            'name' => 'required|min:3',
            'password' => 'required|min:5',
        ]);
        if($validator){
            return Response::json(['status'=>$validator]);
        }
        $user = User::create([
            'uuid' => UUID::generateUuid(),
            'username' => $request->username,
            'password' => password_hash($request->password, PASSWORD_BCRYPT),
            'name' => $request->name,
            'section' => $request->section,
            'singkatan' => $request->alias_section,
            'role_id' => $request->role_id,
            'created_at' => Date::Now(),
            'updated_at' => Date::Now(),
        ]);
        if($user){
            return Response::json(['status'=>201,'message'=>'User berhasil ditambahkan']);
        }
    }

    public function update(Request $request,$id)
    {
        $user = User::query()->where('uuid',$id)->first();
        if(!$user){
            return Response::json(['status'=>404,'message'=>'User tidak ditemukan']);
        }
        $user->name = $request->name;
        if($request->password){
            $user->password = password_hash($request->password,PASSWORD_BCRYPT);
        }
        $user->group_tim = $request->group_tim;
        $user->group_section = $request->group_section;
        $user->role_id = $request->role_id;
        $user->updated_at = Date::Now();
        $user->save();
        return Response::json(['status'=>201,'message'=>'User berhasil diupdate']);
    }

    public function delete(Request $request,$id)
    {
        $user = User::query()->where('uuid',$id)->first();
        $user->delete();
        return Response::json(['status'=>200,'message'=>'User berhasil dihapus']);
    }

    public function profile(Request $request, $id)
    {
        $user = User::query()->where('uuid','=',$id)->first();
        return view('users/profil',['user'=>$user],'layout/app');
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::query()->where('uuid','=',$id)->first();
        if($user->username == Session::user()->username){
            $user->name = $request->name;
            $user->section = $request->section;
            $user->singkatan = $request->alias_sect;
            if($request->password){
                $user->password = password_hash($request->password,PASSWORD_BCRYPT);
            }
            $user->save();
            Session::flash('success', 'Profile berhasil diperbarui!');
            return redirect('/home');
        }
        Response::json(['status'=>403,'message'=>'Forbiden Access for update profile isnt you']);
    }
}
