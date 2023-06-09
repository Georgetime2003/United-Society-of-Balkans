<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\Reports as DBReports;

class Users extends Controller
{
    /**
     * Show the list of users.
     */
    public function index()
    {
        $users = User::where('role', '!=', 'superadmin')->get();
        return view('users')->with('users', $users);
    }

    /**
     * Show the user data.
     * @param $id The id of the user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View It returns the view with the user data, or the list of users if the user doesn't exist
     */
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

    /**
     * Update the user data.
     * @param Request $request The request with the data to update
     * @return \Illuminate\Http\JsonResponse It returns a json response with the status of the update
     */
    public function update(Request $request){
        $user = User::find($request->id);
        if(!$user){
            return redirect()->route('users');
        }
        $user->name = $request->name;
        $user->surnames = $request->surnames;
        $user->email = $request->email;
        //Depends of the role selected, it will fill the data which is needed in any case, and will empty the data which is not needed
        switch ($request->role) {
            case '1':
                $user->role = 'volunteer';
                $user->organization = null;
                $user->start_date = $request->start_date;
                $user->end_date = $request->end_date;
                $user->volunteer_code = $request->volunteer_code;
                $user->hosting = $request->hosting;
                $user->sending = $request->sending;
                break;
            case '2':
                $user->role = 'house';
                break;
            case '3':
                $user->role = 'organization';
                $user->organization = $request->organization;
                $user->start_date = null;
                $user->end_date = null;
                $user->volunteer_code = null;
                $user->hosting = null;
                $user->sending = null;
                break;
            case '4':
                $user->role = 'admin';
                break;
        }
        //If the user is new, it will send an email to the user with the data, checking if its volunteer or organization because there's a different email for each one
        if ($request->start_date != null || $request->end_date != null || $request->volunteer_code != null || $request->hosting != null || $request->sending != null && $user->newUser == true){
            $mailStatus = mailNewUser($user);
            if ($mailStatus == 'Email sent'){
                $user->newUser = false;
            } else {
                return response()->json(['error' => $mailStatus]);
            }
            $user->newUser = false;
        } else if ($request->organization != null && $user->newUser == '1'){
            $mailStatus = mailNewOrganization($user);
            if ($mailStatus == 'Email sent'){
                $user->newUser = false;
            } else {
                return response()->json(['error' => $mailStatus]);
            }
            $user->newUser = false;
        }
        //Save the user and send response
        $user->save();
        $success = ['success' => 'User updated successfully!'];
        return response()->json($success);
    }

    /**
     * Delete the user.
     * @param $id The id of the user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector It returns the list of users
     */
    public function delete($id){
        $user = User::find($id);
        if(!$user){
            return redirect()->route('users');
        }
        $reports = DBReports::where('user_id', $id)->get();
        foreach ($reports as $report) {
            $report->delete();
        }
        $user->delete();
        return redirect()->route('users');
    }

    /**
     * Show the user data.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View It returns the view with the user data with view only permissions, except for the avatar
     */
    public function config(){
        //Get user logged in
        $user = Auth::user();
        if(!$user){
            return dd(Auth::user());
        }
        return view('user')->with('user', $user)->with('admin', false);
    }

    

}

/**
 * Send an email to the user with the data.
 * @param $user The user to send the email
 * @return string It returns the status of the email
 */
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

/**
 * Send an email to the user with the data.
 * @param $user The user to send the email
 * @return string It returns the status of the email
 */
function mailNewOrganization($user) {
    $data = [
        'name' => $user->name,
        'surnames' => $user->surnames,
        'email' => $user->email,
        'organization' => $user->organization,
        'role' => $user->role
    ];
    try{
        Mail::to($user->email)->send(new \App\Mail\registerOrganization($data));
        return 'Email sent';
    } catch (\Exception $e) {
        return $e->getMessage();
    }
}
