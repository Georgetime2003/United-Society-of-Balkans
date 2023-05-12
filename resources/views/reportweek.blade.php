@extends('layout')
@section('header')
@if($edit)
	<script src="{{ asset('js/weeklyreport.js') }}"></script>
@endif
@endsection
@section('site_content')
@csrf
<div class="mb-2"></div>
<div class="toast align-items-center text-bg-success border-0 position-absolute my-3 top-0 start-50 translate-middle-x z-index-toast" tabindex="-1" role="alert" aria-live="assertive" aria-atomic="true">
	<div class="d-flex">
		<div class="toast-body">
			The day has been saved successfully!
		</div>
		<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
	</div>
</div>
<div class="container">
	<div class="mb-2"></div>
    <div class="row">
        <div class="col-12">
            <h2 data-header="h1" class="title my-5">{{$user->name . " " . $user->surnames . "'s "}} Weekly Report</h2>
            <div class="row">
                <div class="card border-1 shadow rounded-3">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="mb-2"></div>
								<div class="col-12">
									<a href="/reports/{{$user->id}}" class="btn btn-warning"><i class="fa-solid fa-backward"></i></a>
								</div>
								<div class="col-12">
									<hr class="my-2">
								</div>
								<div class="col-12">
								<table class="table">
									<thead>
										<tr>
											<th>Day</th>
											<th>4H</th>
											<th>2H</th>
										</tr>
									</thead>
									<tbody class="table-group-divider">
										<tr>
											<th>Monday</th>
											<td id="monday4" @if($edit) contenteditable @endif>{{$report->monday_4}}</td>
											<td id="monday2" @if($edit) contenteditable @endif>{{$report->monday_2}}</td>
										</tr>
										<tr>
											<th>Tuesday</th>
											<td id="tuesday4" @if($edit) contenteditable @endif>{{$report->tuesday_4}}</td>
											<td id="tuesday2" @if($edit) contenteditable @endif>{{$report->tuesday_2}}</td>
										</tr>
										<tr>
											<th>Wednesday</th>
											<td id="wednesday4" @if($edit) contenteditable @endif>{{$report->wednesday_4}}</td>
											<td id="wednesday2" @if($edit) contenteditable @endif>{{$report->wednesday_2}}</td>
										</tr>
										<tr>
											<th>Thursday</th>
											<td id="thursday4" @if($edit) contenteditable @endif>{{$report->thursday_4}}</td>
											<td id="thursday2" @if($edit) contenteditable @endif>{{$report->thursday_2}}</td>
										</tr>
										<tr>
											<th>Friday</th>
											<td id="friday4" @if($edit) contenteditable @endif>{{$report->friday_4}}</td>
											<td id="friday2" @if($edit) contenteditable @endif>{{$report->friday_2}}</td>
										</tr>
										<tr class="table-group-divider" style="border-top: 4px solid #2c2c2c;">
											<th>Extra</th>
											<td id="extra" colspan="2" @if($edit) contenteditable @endif>{{$report->extra}}</td>
										</tr>
									</tbody>
								</table>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<input type="integer" id="reportid" value="{{$report->id}}" hidden>
<input type="integer" id="userid" value="{{$user->id}}" hidden>
@endsection
<script>
	console.log("{{$report}}");
</script>