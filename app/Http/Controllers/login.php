<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class login extends Controller
{
    /**
     * Redirect the user to the OAuth Provider selected.
     * @param Request $request The request with the provider that the user selected
     * @return \Illuminate\Http\Response The response with the redirect to the OAuth Provider
     */
    public function Oauth(Request $request){
        return Socialite::driver($request->provider)->redirect();
    }

    /**
     * Obtain the user information from the OAuth Provider.
     * @return \Illuminate\Http\Response It will load the main site if the user is registered, otherwise it will redirect to the login page
     */
    public function GoogleCallback(){
        $user = Socialite::driver('google')->user();
        $login = User::where('email', $user->email)->first();
        if($login){
            Auth::login($login);
            return redirect()->route('reports');
        }else{
            return redirect()->route('login')->with('error', 'You are not registered, try another account or contact with USB');
        }
    }

    /**
     * Obtain the user information from the OAuth Provider.
     * @return \Illuminate\Http\Response It will load the main site if the user is registered, otherwise it will redirect to the login page
     */
    public function FacebookCallback(){
        $user = Socialite::driver('facebook')->user();
        $login = User::where('email', $user->email)->first();
        if($login){
            $users = User::all();
            return redirect()->route('reports');
        }else{
            return redirect()->route('login')->with('error', 'You are not registered, try another account or contact with USB');
        }
    }
    /**
     * Logout the user.
     * @return \Illuminate\Http\Response It will redirect to the login page
     */
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
