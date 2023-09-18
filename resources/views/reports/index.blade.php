@extends('layout')
@section('header')
    {{-- <script src="{{ asset('js/home.js') }}"></script> --}}
@endsection
@section('site-content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Organization List</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow rouded-3">
                    <div class="card-body top-3">
                        <div class="row">
                            <div class="col-12">
                                <table class="table-info table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Organization</th>
                                            <th>Pendent Reports</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($organizations as $organization)
                                            <tr>
                                                <a href="{{ route('reports.show', $organization->id) }}">
                                                    <td>{{ $organization->name }}</td>
                                                    <td>{{ $organization->reports->count() }}</td>
                                                </a>
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