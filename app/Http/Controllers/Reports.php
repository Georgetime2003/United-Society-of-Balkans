<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reports as DBReports;
use App\Models\User;

class Reports extends Controller
{
    public function schedule(){
        //Get users that are volunteers and are active (start_date <= today <= end_date)
        $users = User::where('role', 'volunteer')->where('start_date', '<=', date('Y-m-d'))->where('end_date', '>=', date('Y-m-d'))->get();
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
}
