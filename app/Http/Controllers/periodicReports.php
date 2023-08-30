<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\periodicReports as DBperiodicReports;

class periodicReports extends Controller
{
    public function index() {
        if (Auth::user->role == 'admin' || Auth::user->role == 'superadmin'){
            return view('periodicReports.index');
        } else if (Auth::user->role == 'organization'){
            $volunteers = User::where('organization_id', Auth::user->organization_id)->get();
            return view('periodicReports.volunteersO', ['volunteers' => $volunteers]);
        } else {
            return redirect()->route('home');
        }
    }

    public function viewOrganizations(Request $request) {
        $organizations = User::where('role', 'organization')->get();
        return view('periodicReports.organizations', ['organizations' => $organizations]);
    }

    public function viewOrganizationReports(Request $request) {
        $reports = DBperiodicReports::where('organization_id', $request->organization_id)->get();
        return view('periodicReports.organizationReports', ['reports' => $reports]);
    }

    public function volunteerReport(Request $request) {
        $type = $request->type;
        $report = DBPeriodicReports::where('user_id', $request->user_id)->where('type', $type)->first();
        if ($report == null){
            return error (404);
        }
        return view('periodicReports.volunteerReport', ['report' => $report]);
    }

    public function generateReport(Request $request){
        $report = new DBPeriodicReports;
        $report->user_id = $request->user_id;
        $report->organization_id = $request->organization_id;
        $report->type = $request->type;
        $report->content = $request->content;
        $report->save();
        Mail::to(User::where('id', $request->organization_id)->first()->email)->send(new newOrganizationReport([
            'organizationName' => User::where('id', $request->organization_id)->first()->name,
            'organizationEmail' => User::where('id', $request->organization_id)->first()->email,
            'volunteerName' => User::where('id', $request->user_id)->first()->name,
            'volunteerEmail' => User::where('id', $request->user_id)->first()->email,
        ]));
        return redirect()->route('periodicReports');
    }

    public function saveReport(Request $request) {

    }

    public function printReport() {

    }
}
