@extends('layout')
@section('site_content')
<div class="background-fixed">
    <div class="container">
        <div class="row">
            <div class="col-12 fade-left-home">
                <h2 data-header="h1" class="title my-5">Welcome {{ Auth::user()->name }} {{ Auth::user()->surnames }} @if( Auth::user()->role == 'organization') from {{ Auth::user()->organization_name }} @endif</h2>
            </div>
            <div class="col-4 fade-right">
                <img src="{{Auth::user()->avatar}}" alt="Avatar" class="img-fluid rounded-circle">
            </div>
            <div class="col-8 fade-up-home">
                <div class="card border-1 shadow rounded-3">
                    <div class="card-body p-4">
                        <div class="mb-2">
                            <div class="row">
                                @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
                                    <div class="col-lg-4 col-md-6 col-12" style="margin-bottom: 2%">
                                        <div class="card card-selector border-1 shadow rouded-3">
                                            <a href="{{ route('users') }}" class="linkmenu">
                                                <div class="card-body">
                                                    <i class="fas fa-users start-icons fa-2x"></i>
                                                    <span class="offset-1">Users Management</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12" style="margin-bottom: 2%">
                                        <div class="card card-selector border-1 shadow rouded-3">
                                            <a href="{{ route('reports') }}" class="linkmenu">
                                                <div class="card-body">
                                                    <i class="fas fa-file-alt start-icons fa-2x"></i>
                                                    <span class="offset-1">Reports Management</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12" style="margin-bottom: 2%">
                                        <div class="card card-selector border-1 shadow rouded-3">
                                            <a href="{{ route('organizations') }}" class="linkmenu">
                                                <div class="card-body">
                                                    <i class="fas fa-building start-icons fa-2x"></i>
                                                    <span class="offset-1">Organization Reports</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12" style="margin-bottom: 2%">
                                        <div class="card card-selector border-1 shadow rouded-3">
                                            <a href="{{ route('forum') }}" class="linkmenu">
                                                <div class="card-body">
                                                    <i class="fas fa-comments start-icons fa-2x"></i> <span
                                                        class="offset-1">Forum</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @elseif(Auth::user()->role == 'volunteer')
                                    <div class="col-lg-4 col-md-6 col-12" style="margin-bottom: 2%">
                                        <div class="card card-selector border-1 shadow rouded-3">
                                            <a href="/reports/{{ Auth::user()->id }}" class="linkmenu">
                                                <div class="card-body">
                                                    <i class="fas fa-file-alt start-icons fa-2x"></i>
                                                    <span class="offset-1">My Reports</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12" style="margin-bottom: 2%">
                                        <div class="card card-selector border-1 shadow rouded-3">
                                            <a href="{{ route('forum') }}" class="linkmenu">
                                                <div class="card-body">
                                                    <i class="fas fa-comments start-icons fa-2x"></i> <span
                                                        class="offset-1">Forum</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @elseif(Auth::user()->role != 'organization')
                                    <div class="col-lg-4 col-md-6 col-12" style="margin-bottom: 2%">
                                        <div class="card card-selector border-1 shadow rouded-3">
                                            <a href="{{ route('forum') }}" class="linkmenu">
                                                <div class="card-body">
                                                    <i class="fas fa-comments start-icons fa-2x"></i> <span
                                                        class="offset-1">Forum</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @elseif(Auth::user()->role == 'organization')
                                <div class="col-lg-4 col-md-6 col-12" style="margin-bottom: 2%">
                                    <div class="card card-selector border-1 shadow rouded-3">
                                        <a href="/organization/{{Auth::user()->id}}" class="linkmenu">
                                            <div class="card-body">
                                                <i class="fas fa-building start-icons fa-2x"></i> <span
                                                    class="offset-1">Volunteers' Reports</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @endif
                                <div class="col-lg-4 col-md-6 col-12" style="margin-bottom: 2%">
                                    <div class="card card-selector border-1 shadow rouded-3">
                                        <a href="/user/config" class="linkmenu">
                                            <div class="card-body">
                                                <i class="fas fa-user start-icons fa-2x"></i>
                                                <span class="offset-1">My Profile</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
