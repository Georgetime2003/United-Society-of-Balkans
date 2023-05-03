<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\PushWeeklyReportVolunteers;
use Illuminate\Support\Facades\Notification;

class PushController extends Controller
{
    public function pushWeeklyReport(){
        Notification::send(User::where('role', 'volunteer')->get(), new PushWeeklyReportVolunteers());
    }
}
