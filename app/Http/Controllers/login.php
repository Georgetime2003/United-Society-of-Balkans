<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class login extends Controller
{
    public function Oauth(Request $request){
        return Socialite::driver($request->provider)->redirect();
    }

    public function GoogleCallback(){
        $user = Socialite::driver('google')->user();
        $login = User::where('email', $user->email)->first();
        if($login){
            return redirect()->route('users');
        }else{
            return redirect()->route('login')->with('error', 'You are not registered, try another account or contact with USB');
        }
    }

    public function FacebookCallback(){
        $user = Socialite::driver('facebook')->user();
        $login = User::where('email', $user->email)->first();
        if($login){
            $users = User::all();
            return redirect()->route('users');
        }else{
            return redirect()->route('login')->with('error', 'You are not registered, try another account or contact with USB');
        }
    }
}
