@extends('layout')
@section('header')
    <script src="{{ asset('js/organizationIndex.js') }}"></script>
@endsection
@section('content')
<div class="background-fixed background-animated">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 data-header="h1" class="title my-5">Organization List</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card border-1 shadow rouded-3">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-12">
                                <table id="organizationTable" class="table table-fixed rounded-3">
                                    <thead class="bg-pink text-light">
                                        <tr>
                                            <th>Organization</th>
                                            <th>Pendent Reports</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($organizations as $organization)
                                            <tr id={{ $organization->id }}>
                                                <td>{{ $organization->name }}</td>
                                                <td>{{ $organization->reports }}</td>
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
@endsection