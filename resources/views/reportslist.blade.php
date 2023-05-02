@extends('layout')
@section('header')
<script src="{{ asset('js/reports.js') }}"></script>
@endsection
@section('site_content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 data-header="h1" class="title my-5">Volunteers Reports</h2>
            <div class="row">
                <div class="card border-1 shadow rounded-3">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="mb-2"></div>
                            <div class="col-12 top-3">
                                <table id="taula" class="table table-fixed">
                                    <thead class="bg-warning text-light">
                                        <tr>
                                            <th id="name">Name</th>
                                            <th id="surname">Surname</th>
                                            <th id="mail">E-Mail</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        @foreach ($users as $user)
                                            <tr id="{{$user->id}}">
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->surnames}}</td>
                                                <td>{{$user->email}}</td>
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
@endsection