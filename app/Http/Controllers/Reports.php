<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reports as DBReports;
use App\Models\User;

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
        $user = User::where('id', $userid)->first();
        return view('report')->with('report', $report)->with('user', $user);
    }
}
