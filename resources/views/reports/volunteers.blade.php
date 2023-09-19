@extends('layout')
@section('header')
    <script src="{{ asset('js/organizationVolunteers.js') }}"></script>
@endsection
@section('content')
<div class="background-fixed background-animated">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 data-header="h1" class="title my-5">{{$organization->organization_name}}'s Volunteers</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card border-1 shadow rouded-3">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-12">
                                <table id="volunteersOrganization" class="table table-fixed rounded-3">
                                    <thead class="bg-pink text-light">
                                        <tr>
                                            <th>Volunteer</th>
                                            <th>Reports created</th>
                                            <th>Reports pending</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($volunteers as $volunteer)
                                            <tr id={{ $volunteer->id }}>
                                                <td>{{ $volunteer->name }}</td>
                                                <td>{{ $volunteer->reports }}/2</td>
                                                <td>{{ $volunteer->pending }}</td>
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
<p hidden id="organizationId">{{ $organization->id }}</p>