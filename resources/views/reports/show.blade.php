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
                    <div class="card-body p-4">
                        @if($midterm)
                            <div class="row">
                                <div class="col-12">
                                    <p class="card-text">
                                        <strong>Activities joined or organized by the volunteers (in chronological order, please be
                                        as much detailed as possible): </strong><br/>
                                        {{$midterm->answer1}}
                                    </p>
                                    <p class="card-text">
                                        <strong>Any kind of task-related preparation was offered to the participants: </strong><br/>
                                        {{$midterm->answer2}}
                                    </p>
                                    <p class="card-text">
                                        <strong>Describe any problem(s) or difficulty encountered during the period and the
                                            solution(s) applied: </strong><br/>
                                        {{$midterm->answer3}}
                                    </p>
                                    <p class="card-text">
                                        <strong>Competences (i.e. knowledge, skills and attitudes/behaviours) acquired/improved
                                            by participants in the last period and impact on their present and future: </strong><br/>
                                        {{$midterm->answer4}}
                                    </p>
                                    <p class="card-text">
                                        <strong>5. Impact and benefit on the organization</strong><br/>
                                        {{$midterm->answer5}}
                                    </p>
                                    <p class="card-text">
                                        <strong>Dissemination material (link to articles – videos - social media posts): </strong><br/>
                                        {{$midterm->answer6}}
                                    </p>
                                    <p class="card-text">
                                        <strong>Comments: </strong><br/>
                                        {{$midterm->comments}}
                                    </p>
                                </div>
                            </div>
                    </div>
                    <div class="card-footer bg-pink text-light p-4">
                        <a href="{{route('pdf.report', $midterm->id)}}" class="btn btn-pink">Download Report's PDF</a>
                    </div>
                        @else
                            <div class="row">
                                <div class="col-12">
                                    <p class="card-text">No report available</p>
                                </div>
                            </div> 
                    </div>
                    <div class="card-footer bg-pink text-light p-4">
                        <a href="{{route('reports.create', ['volunteer' => $volunteer->id, 'type' => 'midterm'])}}" class="btn btn-pink">Create Report</a>
                    </div>
                        @endif
                </div>
                <div class="card border-1 shadow rouded-3">
                    <div class="card-title bg-pink text-light p-4">
                        <h3>Final Term Report</h3>
                    </div>
                    <div class="card-body p-4">
                        @if($finalTerm)
                            <div class="row">
                                <div class="col-12">
                                    <p class="card-text">
                                        <strong>Activities joined or organized by the volunteers (in chronological order, please be
                                        as much detailed as possible): </strong><br/>
                                        {{$finalTerm->answer1}}
                                    </p>
                                    <p class="card-text">
                                        <strong>Any kind of task-related preparation was offered to the participants: </strong><br/>
                                        {{$finalTerm->answer2}}
                                    </p>
                                    <p class="card-text">
                                        <strong>Describe any problem(s) or difficulty encountered during the period and the
                                            solution(s) applied: </strong><br/>
                                        {{$finalTerm->answer3}}
                                    </p>
                                    <p class="card-text">
                                        <strong>Competences (i.e. knowledge, skills and attitudes/behaviours) acquired/improved
                                            by participants in the last period and impact on their present and future: </strong><br/>
                                        {{$finalTerm->answer4}}
                                    </p>
                                    <p class="card-text">
                                        <strong>5. Impact and benefit on the organization: </strong><br/>
                                        {{$finalTerm->answer5}}
                                    </p>
                                    <p class="card-text">
                                        <strong>Dissemination material (link to articles – videos - social media posts): </strong><br/>
                                        {{$finalTerm->answer6}}
                                    </p>
                                    <p class="card-text">
                                        <strong>Comments: </strong><br/>
                                        {{$finalTerm->comments}}
                                    </p>
                                </div>
                            </div>
                    </div>
                    <div class="card-footer bg-pink text-light p-4">
                        <a href="{{route('pdf.report', $finalterm->id)}}" class="btn btn-pink">Download Report's PDF</a>
                    </div>
                        @else
                            <div class="row">
                                <div class="col-12">
                                    <p class="card-text">No report available</p>
                                </div>
                            </div> 
                    </div>
                    <div class="card-footer bg-pink text-light p-4">
                        <a href="{{route('reports.create', ['volunteer' => $volunteer->id, 'type' => 'finalterm'])}}" class="btn btn-pink">Create Report</a>
                    </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection