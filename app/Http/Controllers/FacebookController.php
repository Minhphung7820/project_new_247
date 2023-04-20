<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class FacebookController extends Controller
{

    public function FacebookRedirect()
    {
        return Socialite::driver("facebook")->redirect();
    }
    
    

    public function FacebookCallback()
    {
        $userFacebook = Socialite::driver("facebook")->user();

        $this->findOrCreateUser($userFacebook,'facebook');

        return redirect('/tai-khoan')->with("login_facebook_success","Bạn đã đăng nhập bằng Facebook thành công !");
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
