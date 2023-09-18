<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as DBUser;
use App\Models\Organization_reports as DBOrganization_reports;
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
        
    }
}
