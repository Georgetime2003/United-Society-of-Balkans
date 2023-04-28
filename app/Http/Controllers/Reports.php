<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reports as DBReports;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Reports extends Controller
{
    public function schedule(){
        //Get users that are volunteers and are active (start_date <= today <= end_date)
        $users = User::where('role', 'volunteer')->where('start_date', '<=', date('Y-m-d'))->get();
        $length = count($users);
        try{
            for ($i = 0; $i < $length; $i++) {
                DBReports::create([
                    'user_id' => $users[$i]->id,
                    'week_number' => date('W'),
                ]);
            }
            $reports = DBReports::all();
            return dd($reports);
        } catch (\Exception $e) {
            return dd($e . $users[0]);
        }
    }

    public function index(){
        $users = User::where('role', 'volunteer')->where('start_date', '<=', date('Y-m-d'))->where('end_date', '>=', date('Y-m-d'))->get();
        return view('reportslist')->with('users', $users);
    }

    public function listUser($userid){
        $reports = DBReports::where('user_id', $userid)->get();
        for ($i = 0; $i < count($reports); $i++) {
            // With the week number value, get the start and end date of the week
            $dto = new \DateTime();
            $dto->setISODate(date('Y'), $reports[$i]->week_number);
            $reports[$i]->start_date = $dto->format('d/m');
            $dto->modify('+6 days');
            $reports[$i]->end_date = $dto->format('d/m');
            $reports[$i]->filled = 0;
            $reports[$i]->requiredFilled = true;
            if ($reports[$i]->monday_4 != '') {
                $reports[$i]->filled++;
            } else {
                $reports[$i]->requiredFilled = false;
            }
            if ($reports[$i]->tuesday_4 != '') {
                $reports[$i]->filled++;
            } else {
                $reports[$i]->requiredFilled = false;
            }
            if ($reports[$i]->wednesday_4 != '') {
                $reports[$i]->filled++;
            } else {
                $reports[$i]->requiredFilled = false;
            }
            if ($reports[$i]->thursday_4 != '') {
                $reports[$i]->filled++;
            } else {
                $reports[$i]->requiredFilled = false;
            }
            if ($reports[$i]->friday_4 != '') {
                $reports[$i]->filled++;
            } else {
                $reports[$i]->requiredFilled = false;
            }
            if ($reports[$i]->monday_2 != '') {
                $reports[$i]->filled++;
            } else {
                $reports[$i]->requiredFilled = false;
            }
            if ($reports[$i]->tuesday_2 != '') {
                $reports[$i]->filled++;
            } else {
                $reports[$i]->requiredFilled = false;
            }
            if ($reports[$i]->wednesday_2 != '') {
                $reports[$i]->filled++;
            } else {
                $reports[$i]->requiredFilled = false;
            }
            if ($reports[$i]->thursday_2 != '') {
                $reports[$i]->filled++;
            } else {
                $reports[$i]->requiredFilled = false;
            }
            if ($reports[$i]->friday_2 != '') {
                $reports[$i]->filled++;
            } else {
                $reports[$i]->requiredFilled = false;
            }
            if ($reports[$i]->extra != '') {
                $reports[$i]->filled++;
            }

            if ($reports[$i]->filled == 11) {
                $reports[$i]->onday = true;
            } else if($reports[$i]->filled >= 10 && $reports[$i]->requiredFilled == true){
                $reports[$i]->onday = true;
            } else {
                $reports[$i]->onday = false;
            }
        }
        $user = User::where('id', $userid)->first();
        return view('reportsUser')->with('reports', $reports)->with('user', $user);
    }

    public function show($userid, $reportid){
        $report = DBReports::where('id', $reportid)->first();
        if (Auth::user()->role == 'volunteer' && Auth::user()->id != $report->user_id) {
            // return dd(Auth::user());
            return redirect('/home');
        }
        $user = User::where('id', $userid)->first();
        if(Auth::user()->role == 'volunteer' && Auth::user()->id == $report->user_id){
            return view('reportweek')->with('report', $report)->with('user', $user)->with('edit', true);
        } else {
            return view('reportweek')->with('report', $report)->with('user', $user)->with('edit', false);
        }
        // return dd(Auth::user());
    }

    public function updateWeekly(Request $request){
        $user_id = $request->input('userid');
        if (Auth::user()->role == 'volunteer' && Auth::user()->id != $user_id) {
            return response()->json(['status' => 'error', 'message' => 'You are not allowed to edit this report']);
        }
        $report_id = $request->input('reportid');
        $report = DBReports::where('id', $report_id)->first();
        $day = $request->input('day');
        if ($day == "monday_4") {
                $report->monday_4 = $request->input('value');
        } else if ($day == "tuesday_4") {
                $report->tuesday_4 = $request->input('value');
        } else if ($day == "wednesday_4") {
                $report->wednesday_4 = $request->input('value');
        } else if ($day == "thursday_4") {
                $report->thursday_4 = $request->input('value');
        } else if ($day == "friday_4") {
                $report->friday_4 = $request->input('value');
        } else if ($day == "monday_2") {
                $report->monday_2 = $request->input('value');
        } else if ($day == "tuesday_2") {
                $report->tuesday_2 = $request->input('value');
        } else if ($day == "wednesday_2") {
                $report->wednesday_2 = $request->input('value');
        } else if ($day == "thursday_2") {
                $report->thursday_2 = $request->input('value');
        } else if ($day == "friday_2") {
                $report->friday_2 = $request->input('value');
        } else if ($day == "extra") {
                $report->extra = $request->input('value');
        } else {
            return response()->json(['status' => 'error', 'message' => 'Invalid day.']);
        }
        $report->save();
        return response()->json(['success' => $report]);

    }
}
