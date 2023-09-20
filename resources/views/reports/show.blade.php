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
                        @if($midTerm)
                            <div class="row">
                                <div class="col-12">
                                    <p class="card-text">
                                        <strong>1)</strong> Activities joined or organized by the volunteers (in chronological order, please be
                                        as much detailed as possible):<br/>
                                        {{$midTerm->answer1}}
                                    </p>
                                    <p class="card-text">
                                        <strong>2)</strong> Any kind of task-related preparation was offered to the participants: <br/>
                                        {{$midTerm->answer2}}
                                    </p>
                                    <p class="card-text">
                                        <strong>3)</strong> Describe any problem(s) or difficulty encountered during the period and the
                                            solution(s) applied:<br/>
                                        {{$midTerm->answer3}}
                                    </p>
                                    <p class="card-text">
                                        <strong>4)</strong> Competences (i.e. knowledge, skills and attitudes/behaviours) acquired/improved
                                            by participants in the last period and impact on their present and future: <br/>
                                        {{$midTerm->answer4}}
                                    </p>
                                    <p class="card-text">
                                        <strong>5)</strong> Impact and benefit on the organization<br/>
                                        {{$midTerm->answer5}}
                                    </p>
                                    <p class="card-text">
                                        <strong>6)</strong> Dissemination material (link to articles – videos - social media posts): <br/>
                                        {{$midTerm->answer6}}
                                    </p>
                                    <p class="card-text">
                                        <strong>Comments: </strong><br/>
                                        {{$midTerm->comments}}
                                    </p>
                                </div>
                            </div>
                    </div>
                    <div class="card-footer p-4">
                        <a href="{{--{{route('pdf.report', $midTerm->id)}}--}}" class="btn btn-pink text-light">Download Report's PDF</a>
                    </div>
                        @else
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
                        <a href="{{route('organization.create', ['volunteerId' => $volunteer->id, 'organizationId' => $organization->id , 'type' => 'midterm'])}}" class="btn btn-pink text-light">Create Report</a>
                    </div>
                        @endif
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card border-1 shadow rouded-3">
                    <div class="card-title bg-pink text-light p-4">
                        <h3>Final Term Report</h3>
                    </div>
                    <div class="card-body p-4 @if($finalTerm)reports-scroll @else reports-nonscroll @endif">
                        @if($finalTerm)
                            <div class="row">
                                <div class="col-12">
                                    <p class="card-text">
                                        <strong>1)</strong> Activities joined or organized by the volunteers (in chronological order, please be
                                        as much detailed as possible):<br/>
                                        {{$finalTerm->answer1}}
                                    </p>
                                    <p class="card-text">
                                        <strong>2)</strong> Any kind of task-related preparation was offered to the participants: <br/>
                                        {{$finalTerm->answer2}}
                                    </p>
                                    <p class="card-text">
                                        <strong>3)</strong> Describe any problem(s) or difficulty encountered during the period and the
                                            solution(s) applied:<br/>
                                        {{$finalTerm->answer3}}
                                    </p>
                                    <p class="card-text">
                                        <strong>4)</strong> Competences (i.e. knowledge, skills and attitudes/behaviours) acquired/improved
                                            by participants in the last period and impact on their present and future: <br/>
                                        {{$finalTerm->answer4}}
                                    </p>
                                    <p class="card-text">
                                        <strong>5)</strong> Impact and benefit on the organization<br/>
                                        {{$finalTerm->answer5}}
                                    </p>
                                    <p class="card-text">
                                        <strong>6)</strong> Dissemination material (link to articles – videos - social media posts): <br/>
                                        {{$finalTerm->answer6}}
                                    </p>
                                    <p class="card-text">
                                        <strong>Comments: </strong><br/>
                                        {{$finalTerm->comments}}
                                    </p>
                                </div>
                            </div>
                    </div>
                    <div class="card-footer p-4">
                        <a href="{{--{{route('pdf.report', $finalterm->id)}}--}}" class="btn btn-pink text-light">Download Report's PDF</a>
                    </div>
                        @else
                            <div class="row">
                                <p class="card-text">No report Generated.<br/>
                                    @if($volunteer->activateFinalTermReport) <strong>Is recommended to send the report because it pass half of the period.</strong>
                                    @else <strong> Report is not required at this moment.</strong>
                                    @endif
                                </p>
                            </div> 
                    </div>
                    <div class="card-footer text-light p-4">
                        <a href="{{route('organization.create', ['volunteerId' => $volunteer->id, 'organizationId' => $organization->id , 'type' => 'finalterm'])}}" class="btn btn-pink text-light">Create Report</a>
                    </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection