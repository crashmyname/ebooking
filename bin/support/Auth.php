<?php
namespace Support;
use App\Models\User;
use Support\Session;

class Auth{
    public static function attempt($credentials)
    {
        $user = User::query()
                ->where('username','=',$credentials['identifier'])
                ->first();
        if($user && password_verify($credentials['password'],$user->password)){
            Session::set('user', $user->toArray());
            return true;
        }
        return false;
    }
}
?>