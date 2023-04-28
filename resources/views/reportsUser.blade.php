@extends('layout')
@section('header')
<script src="{{ asset('js/reportsuser.js') }}"></script>
@endsection
@section('site_content')
<div class="mb-2"></div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 data-header="h1" class="title my-5">{{$user->name . " " . $user->surnames}}'s Reports</h2>
            <div class="row">
                <div class="card border-1 shadow rounded-3">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="mb-2"></div>
                            <div class="col-12 top-3">
                                <table id="taula" class="table table-fixed">
                                    <thead class="bg-warning text-light">
                                        <tr>
                                            <th id="name">Week</th>
                                            <th id="surname">Filled</th>
                                            <th id="mail">On Day</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        @foreach ($reports as $report)
                                            <tr id="{{$report->id}}">
												<!--With the week number, we can get the first and last day of the week in format dd/mm-->
												<td>{{$report->start_date . " - " . $report->end_date}}</td>
                                                <td>{{$report->filled}}/11</td>
                                                <td>
                                                    @if ($report->onday)
                                                        <i class="fas fa-check-circle text-success"></i>
                                                    @else
                                                        <i class="fas fa-times-circle text-danger"></i>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
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
<input type="number" id="user_id" value="{{$user->id}}" hidden>
@endsection