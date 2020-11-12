<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect($provider)
    {
     return Socialite::driver($provider)->redirect();
    }
    public function Callback($provider){
        $userSocial =   Socialite::driver($provider)->stateless()->user();

        $users       =   User::where(['email' => $userSocial->getEmail()])->first();
        if($users){
            Auth::login($users);
            return redirect('/');
        }else{
            $user =  new User();
            $user->username =  $userSocial->getName();
            $user->email =  $userSocial->getEmail();
            $user->image =  $userSocial->getAvatar();
            $user->provider_id =  $userSocial->getId();
            $user->provider =  $provider;


            $user->save();

            Auth::login($user);
            return redirect()->route('home');
        }
    }
}
