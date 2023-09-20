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
        } else if ($organization->role != 'organization'){
            abort(403);
        }
        $volunteers = DBUser::where('organization_id', $organization->id)->get();
        foreach ($volunteers as $volunteer){
            $volunteer->reports = DBOrganization_reports::where('user_id', $volunteer->id)->where('organization_id', $organization->id)->count();
            $volunteer->pending = DBOrganization_reports::where('user_id', $volunteer->id)->where('organization_id', $organization->id)->where('status', 'pending')->count();
        }
        return view('reports.volunteers')->with('volunteers', $volunteers)->with('organization', $organization);
    }

    public function show($organizationId, $volunteerId){
        $volunteer = DBUser::where('id', $volunteerId)->first();
        $organization = DBUser::where('id', $organizationId)->first();
        if ($volunteer == null || $organization == null){
            abort(404);
        } else if ($volunteer->role != 'volunteer' || $organization->role != 'organization'){
            abort(403);
        }
        //If the volunteer passed half of the time it will recommend to do the report
        $volunteer->days = date_diff(DateTime::createFromFormat('Y-m-d', $volunteer->start_date), DateTime::createFromFormat('Y-m-d', $volunteer->end_date));
        $volunteer->today = date_diff(DateTime::createFromFormat('Y-m-d', $volunteer->start_date), new DateTime());
        if ($volunteer->today->d > $volunteer->days->d/2){
            $volunteer->activateMidTermReport = true;
        }
        if ($volunteer->today->d > $volunteer->days->d){
            $volunteer->activateFinalTermReport = true;
        }
        $midterm = DBOrganization_reports::where('user_id', $volunteerId)->where('organization_id', $organizationId)->where('type', '0')->first();
        $finalterm = DBOrganization_reports::where('user_id', $volunteerId)->where('organization_id', $organizationId)->where('type', '1')->first();
        return view('reports.show')->with('midTerm', $midterm)->with('finalTerm', $finalterm)->with('volunteer', $volunteer)->with('organization', $organization);
    }

    public function create($volunteerId, $organizationId, $type){
        $volunteer = DBUser::where('id', $volunteerId)->first();
        if ($volunteer == null){
            abort(404);
        } else if ($volunteer->role != 'volunteer'){
            abort(403);
        }
        $organization = DBUser::where('id', $organizationId)->first();
        if ($organization == null){
            abort(404);
        } else if ($organization->role != 'organization'){
            abort(403);
        }
        DBOrganization_reports::create([
            'user_id' => $volunteerId,
            'organization_id' => $organizationId,
            'type' => $type == 'midterm' ? 0 : 1,
            'status' => 'pending'
        ]);
        return redirect()->route('organization.show', ['volunteerId' => $volunteerId, 'organizationId' => $organizationId]);
    }
}
