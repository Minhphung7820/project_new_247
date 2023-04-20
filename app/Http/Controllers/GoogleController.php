<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Two\InvalidStateException;

class GoogleController extends Controller
{
    public function GoogleRedirect(){
           return Socialite::driver('google')->redirect();
    }
    public function GoogleCallback(){
       
        $userGoogle = Socialite::driver('google')->user(); 
        $this->findOrCreateUser($userGoogle, 'google');
        return redirect('/tai-khoan')->with("login_google_success","Bạn đã đăng nhập bằng Google thành công !");
    }
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('email',"=", $user->email)->where("provider","!=",null)->first();
        if ($authUser) {
                      $authUser->update([
                        "id_provider"=>$user->id,
                         "provider"=>$provider,
                         "name"=>$user->name,
                         'avatar'=>$user->avatar
                       ]);
        }else{
            $authUser =  User::create([
                'name'     => $user->name,
                'email'    => $user->email,
                'provider' => $provider,
                'id_provider' => $user->id,
                'avatar'=>$user->avatar
            ]);
        }
        Auth::login($authUser);
 
    }
}
