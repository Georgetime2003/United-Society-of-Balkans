<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as DBUser;
use App\Models\PeriodicReports as DBOrganization_reports;
use DateTime;

class OrganizationReports extends Controller
{
    public function shedule() {
        $organizations = DBUser::where('role', 'organization')->get();
        foreach ($organizations as $organization){
            $volunteers = DBUser::where('hosting', $organization->organization)->get();
            foreach ($volunteers as $volunteer){
                $volunteer->days = date_diff($volunteer->start_date, $volunteer->end_date);
                $volunteer->today = date_diff($volunteer->start_date, new DateTime());
                if ($volunteer->today > $volunteer->days/2){
                    $report = DBOrganization_reports::where('volunteer_id', $volunteer->id)->where('organization_id', $organization->id)->first();
                    if (!$report){
                        DBOrganization_reports::create([
                            'volunteer_id' => $volunteer->id,
                            'organization_id' => $organization->id,
                            'status' => 'pending'
                        ]);
                    }
                }
            }
        }
    }

    public function index() {
        $organizations = DBUser::where('role', 'organization')->get();
        foreach ($organizations as $organization){
            $organization->pending = DBOrganization_reports::where('organization_id', $organization->id)->where('status', 'pending')->count();
            if ($organization->pending == 0) $organization->pending = "🆗";
            $organization->reports = DBOrganization_reports::where('organization_id', $organization->id)->where('status', '!=', 'pending')->count();
        }
        return view('reports.index')->with('organizations', $organizations);
    }

    public function showVolunteers($id){
        $organization = DBUser::where('id', $id)->first();
        if ($organization == null){
            abort(404);
        }
        $volunteers = DBUser::where('organization_id', $organization->id)->get();
        foreach ($volunteers as $volunteer){
            $volunteer->reports = DBOrganization_reports::where('user_id', $volunteer->id)->where('organization_id', $organization->id)->get();
            $volunteer->pending = DBOrganization_reports::where('user_id', $volunteer->id)->where('organization_id', $organization->id)->where('status', 'pending')->first();
        }
        return view('reports.volunteers')->with('volunteers', $volunteers)->with('organization', $organization);
    }
}
