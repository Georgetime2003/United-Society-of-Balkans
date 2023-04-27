<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class Users extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'superadmin')->get();
        return view('users')->with('users', $users);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user && $id == 'new') {
            User::create([
                'name' => 'New User',
                'role' => 'user'
            ]);
            $user = User::where('role', 'user')->orderBy('id', 'desc')->first();
            return redirect()->route('users.show', ['id' => $user->id]);
        } else if(!$user) {
            return redirect()->route('users');
        }
        return view('user')->with('user', $user)->with('admin', true);
    }

    public function update(Request $request){
        $user = User::find($request->id);
        if(!$user){
            return redirect()->route('users');
        }
        $user->name = $request->name;
        $user->surnames = $request->surnames;
        $user->email = $request->email;
        $user->start_date = $request->start_date;
        $user->end_date = $request->end_date;
        $user->volunteer_code = $request->volunteer_code;
        switch ($request->role) {
            case '1':
                $user->role = 'volunteer';
                break;
            case '2':
                $user->role = 'house';
                break;
            case '3':
                $user->role = 'organization';
                break;
            case '4':
                $user->role = 'admin';
                break;
        }
        $user->hosting = $request->hosting;
        $user->sending = $request->sending;
        if ($request->start_date != null || $request->end_date != null || $request->volunteer_code != null || $request->hosting != null || $request->sending != null && $user->newUser == true){
            $mailStatus = mailNewUser($user);
            if ($mailStatus == 'Email sent'){
                $user->newUser = false;
            } else {
                return response()->json(['error' => $mailStatus]);
            }
            $user->newUser = false;
        }
        $user->save();
        $success = ['success' => 'User updated successfully!'];
        return response()->json($success);
    }

    public function delete($id){
        $user = User::find($id);
        if(!$user){
            return redirect()->route('users');
        }
        $user->delete();
        return redirect()->route('users');
    }

    public function config(){
        //Get user logged in
        $user = Auth::user();
        if(!$user){
            return dd(Auth::user());
        }
        return view('user')->with('user', $user)->with('admin', false);
    }

}
function mailNewUser($user){
    $data = [
        'name' => $user->name,
        'surnames' => $user->surnames,
        'email' => $user->email,
        'start_date' => $user->start_date,
        'end_date' => $user->end_date,
        'volunteer_code' => $user->volunteer_code,
        'hosting' => $user->hosting,
        'sending' => $user->sending,
        'role' => $user->role,
    ];
    try{
    Mail::to($user->email)->send(new \App\Mail\registerUSB($data));
    return 'Email sent';
    } catch (\Exception $e) {
        return $e->getMessage();
    }
}
