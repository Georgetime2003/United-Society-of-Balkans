@extends('layout')
@section('header')
    <script src="{{ asset('js/organizationForm.js') }}"></script>
@endsection
@section('content')
<div class="background-fixed background-animated">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 data-header="h1" class="title my-5">{{$volunteer->name}}'s {{$report->type == 0 ? 'Midterm' : 'Final'}} Report</h2>
            </div>
        </div>
        <div class="card border-1 shadow rounded-3">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-12">
                        <form method="POST" enctype="multipart/form-data" id="report" action="/organization/save/{{$report->id}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <label for="answer1" class="form-label"><strong>1)</strong> Activities joined or organized by the volunteers (in chronological order, please be
                                        as much detailed as possible): </label>
                                    <input type="text" class="form-control" id="answer1" name="answer1" value="{{$report->answer1}}" required>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="answer2" class="form-label"><strong>2)</strong> Any kind of task-related preparation was offered to the participants: </label>
                                    <input type="text" class="form-control" id="answer2" name="answer2" value="{{$report->answer2}}" required>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="answer3" class="form-label"><strong>3)</strong> Describe any problem(s) or difficulty encountered during the period and the
                                        solution(s) applied:</label>
                                    <input type="text" class="form-control" id="answer3" name="answer3" value="{{$report->answer3}}" required>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="answer4" class="form-label"><strong>4)</strong> Competences (i.e. knowledge, skills and attitudes/behaviours) acquired/improved
                                        by participants in the last period and impact on their present and future: </label>
                                    <input type="text" class="form-control" id="answer4" name="answer4" value="{{$report->answer4}}" required>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="answer5" class="form-label"><strong>5)</strong> Impact and benefit on the organization: </label>
                                    <input type="text" class="form-control" id="answer5" name="answer5" value="{{$report->answer5}}" required>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="answer6" class="form-label"><strong>6)</strong> Dissemination material (link to articles – videos - social media posts):  </label>
                                    <input type="text" class="form-control" id="answer6" name="answer6" value="{{$report->answer6}}" required>
                                </div>
                                <div class="col-12">
                                    <label for="comments" class="form-label">Comments: </label>
                                    <textarea class="form-control" id="comments" name="comments" rows="3" required>{{$report->comments}}</textarea>
                                </div>
                                <div class="mb-2"></div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-pink text-light">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
