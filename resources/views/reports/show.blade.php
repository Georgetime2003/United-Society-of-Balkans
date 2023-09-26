@extends('layout')
@section('header')
    <script src="{{ asset('js/organizationIndex.js') }}"></script>
@endsection
@section('content')
<div class="background-fixed background-animated">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 data-header="h1" class="title my-5">{{$volunteer->name}}'s Periodic Reports</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="card border-1 shadow rouded-3">
                    <div class="card-title bg-pink text-light p-4">
                        <h3>Mid-Term Report</h3>
                    </div>
                    <div class="card-body py-0 @if($midTerm)reports-scroll @else reports-nonscroll @endif">
                        @if($midTerm && $midTerm->status != 'pending')
                            <div class="row">
                                <div class="col-12">
                                    <p class="card-text">
                                        <strong>1)</strong> Activities joined or organized by the volunteers (in chronological order, please be
                                        as much detailed as possible):<br/>
                                        <u>{{$midTerm->answer1}}</u>
                                    </p>
                                    <p class="card-text">
                                        <strong>2)</strong> Any kind of task-related preparation was offered to the participants: <br/>
                                        <u>{{$midTerm->answer2}}</u>
                                    </p>
                                    <p class="card-text">
                                        <strong>3)</strong> Describe any problem(s) or difficulty encountered during the period and the
                                            solution(s) applied:<br/>
                                        <u>{{$midTerm->answer3}}</u>
                                    </p>
                                    <p class="card-text">
                                        <strong>4)</strong> Competences (i.e. knowledge, skills and attitudes/behaviours) acquired/improved
                                            by participants in the last period and impact on their present and future: <br/>
                                        <u>{{$midTerm->answer4}}</u>
                                    </p>
                                    <p class="card-text">
                                        <strong>5)</strong> Impact and benefit on the organization: <br/>
                                        <u>{{$midTerm->answer5}}</u>
                                    </p>
                                    <p class="card-text">
                                        <strong>6)</strong> Dissemination material (link to articles – videos - social media posts): <br/>
                                        <u>{{$midTerm->answer6}}</u>
                                    </p>
                                    <p class="card-text">
                                        <strong>Comments: </strong><br/>
                                        <u>{{$midTerm->comment}}</u>
                                    </p>
                                </div>
                            </div>
                    </div>
                    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                    <div class="card-footer p-4">
                        <a href="{{--{{route('pdf.report', $midTerm->id)}}--}}" class="btn btn-pink text-light">Download Report's PDF</a>
                    </div>
                    @else
                    <div class="card-footer p-4">
                        <a href="{{route('organization.fill', ['volunteerId' => $volunteer->id, 'organizationId' => $organization->id , 'reportId' => $midTerm->id])}}" class="btn btn-pink text-light">Edit Report</a>
                    </div>
                    @endif
                        @elseif(!$midTerm)
                            <div class="row">
                                <div class="col-12">
                                    <p class="card-text">No report Generated.<br/>
                                        @if($volunteer->activateMidTermReport) <strong>Is recommended to send the report because it pass half of the period.</strong>
                                        @else <strong>The Report is not required at this moment.</strong>
                                        @endif
                                    </p>
                                </div>
                            </div> 
                    </div>
                    <div class="card-footer p-4">
                        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                        <a href="{{route('organization.create', ['volunteerId' => $volunteer->id, 'organizationId' => $organization->id , 'type' => 'midterm'])}}" class="btn btn-pink text-light">Create Report</a>
                        @endif
                    </div>
                        @elseif($midTerm->status == 'pending' && $midTerm->organization_id == Auth::user()->id)
                            <div class="row">
                                <div class="col-12">
                                    <p class="card-text">The report is ready to be filled.</p>
                                </div>
                            </div>
                    </div>
                    <div class="card-footer p-4">
                        @if(Auth::user()->role == 'organization')
                        <a href="{{route('organization.fill', ['volunteerId' => $volunteer->id, 'organizationId' => $organization->id , 'reportId' => $midTerm->id])}}" class="btn btn-pink text-light">Edit Report</a>
                        @endif
                    </div>
                        @else
                            <div class="row">
                                <div class="col-12">
                                    <p class="card-text">The report is pending to be filled.</p>
                                </div>
                            </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card border-1 shadow rouded-3">
                    <div class="card-title bg-pink text-light p-4">
                        <h3>Final Term Report</h3>
                    </div>
                    <div class="card-body py-0 @if($finalTerm)reports-scroll @else reports-nonscroll @endif">
                        @if($finalTerm && $finalTerm->status != 'pending')
                            <div class="row">
                                <div class="col-12">
                                    <p class="card-text">
                                        <strong>1)</strong> Activities joined or organized by the volunteers (in chronological order, please be
                                        as much detailed as possible):<br/>
                                        <u>{{$finalTerm->answer1}}</u>
                                    </p>
                                    <p class="card-text">
                                        <strong>2)</strong> Any kind of task-related preparation was offered to the participants: <br/>
                                        <u>{{$finalTerm->answer2}}</u>
                                    </p>
                                    <p class="card-text">
                                        <strong>3)</strong> Describe any problem(s) or difficulty encountered during the period and the
                                            solution(s) applied:<br/>
                                        <u>{{$finalTerm->answer3}}</u>
                                    </p>
                                    <p class="card-text">
                                        <strong>4)</strong> Competences (i.e. knowledge, skills and attitudes/behaviours) acquired/improved
                                            by participants in the last period and impact on their present and future: <br/>
                                        <u>{{$finalTerm->answer4}}</u>
                                    </p>
                                    <p class="card-text">
                                        <strong>5)</strong> Impact and benefit on the organization<br/>
                                        <u>{{$finalTerm->answer5}}</u>
                                    </p>
                                    <p class="card-text">
                                        <strong>6)</strong> Dissemination material (link to articles – videos - social media posts): <br/>
                                        <u>{{$finalTerm->answer6}}</u>
                                    </p>
                                    <p class="card-text">
                                        <strong>Comments: </strong><br/>
                                        <u>{{$finalTerm->comment}}</u>
                                    </p>
                                </div>
                            </div>
                    </div>
                    <div class="card-footer p-4">
                        @if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                        <a href="{{--{{route('pdf.report', $finalterm->id)}}--}}" class="btn btn-pink text-light">Download Report's PDF</a>
                        @elseif(Auth::user()->role == 'organization')
                            <a href="{{route('organization.fill', ['volunteerId' => $volunteer->id, 'organizationId' => $organization->id , 'reportId' => $finalTerm->id])}}" class="btn btn-pink text-light">Edit Report</a>
                        @endif
                    </div>
                        @elseif (!$finalTerm)
                            <div class="row">
                                <p class="card-text">No report Generated.<br/>
                                    @if($volunteer->activateFinalTermReport) <strong>Is recommended to send the report because it pass half of the period.</strong>
                                    @else <strong> Report is not required at this moment.</strong>
                                    @endif
                                </p>
                            </div> 
                    </div>
                    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
                    <div class="card-footer text-light p-4">
                        <a href="{{route('organization.create', ['volunteerId' => $volunteer->id, 'organizationId' => $organization->id , 'type' => 'finalterm'])}}" class="btn btn-pink text-light">Create Report</a>
                    </div>
                    @endif
                        @elseif($finalTerm->status == 'pending' && $finalTerm->organization_id == Auth::user()->id)
                            <div class="row">
                                <div class="col-12">
                                    <p class="card-text">The report is ready to be filled.</p>
                                </div>
                            </div>
                    </div>
                    <div class="card-footer p-4">
                        @if(Auth::user()->role == 'organization')
                            <a href="{{route('organization.fill', ['volunteerId' => $volunteer->id, 'organizationId' => $organization->id , 'reportId' => $finalTerm->id])}}" class="btn btn-pink text-light">Edit Report</a>
                        @endif
                    </div>
                        @else
                            <div class="row">
                                <div class="col-12">
                                    <p class="card-text">The report is pending to be filled.</p>
                                </div>
                            </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection