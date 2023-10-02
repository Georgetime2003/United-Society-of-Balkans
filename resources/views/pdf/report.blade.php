<!DOCTYPE html>
<html>
    <head>
        <title>Report</title>
        <style>
            body {
                font-family: 'DejaVu Sans';
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <img src="{{base_path('public/images/logo.png')}}" alt="logo" style="width: 19%; height: auto;">
                    <img src="{{public_path('images/erasmus+.png')}}" alt="logo" style="margin: 0 -10% 0 70%; position: relative; top: -50;">
                </div>
            </div>
            <div class="mb-2"></div>
            <div class="row">
                <div class="col-12 text-center">
                    <h3 style="text-align: center">{{$volunteer->name}} {{$volunteer->surnames}}'s {{ $title }}</h3>
                </div>
                <div class="mb-2"></div>
                <div class="col-12">
                    <p class="text-justify"><strong><u> Answer the following questions if applicable. </u></strong></p>
                </div>
                <div class="col-12">
                    <ol>
                        <li><strong class="question">Activities joined or organized by the volunteers (in chronological order, please be as much detailed as possible):</strong><br>
                        {{$report->answer1}}<br><br></li>
                        <li><strong class="question">Any kind of task-related preparation was offered to the participants:</strong><br>
                        {{$report->answer2}}<br><br></li>
                        <li><strong class="question">Describe any problem(s) or difficulty encountered during the period and the solution(s) applied: </strong><br>
                        {{$report->answer3}}<br><br></li>
                        <li><strong class="question">Competences (i.e. knowledge, skills and attitudes/behaviours) acquired/improved by participants in the last period and impact on their present and future: </strong><br>
                        {{$report->answer4}}<br><br></li>
                        <li><strong class="question">Impact and benefit on the organization: </strong><br>
                        {{$report->answer5}}<br><br></li>
                        <li><strong class="question">Dissemination material (link to articles – videos - social media posts): </strong><br>
                        {{$report->answer6}}<br><br></li>
                        <li><strong class="question">Comments: </strong><br>
                        {{$report->comment}}</li>
                </div>
            </div>
    </body>
</html>