@extends('header')
@section('content')
<main class="bg-image">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card border-0 shadow rounded-3 my-5">
                        <div class="card-body p-4 p-sm-5">
                            <img src="{{asset('logo.png')}}" alt="logo" class="rounded mx-auto d-block" style="width: 75%; height: auto;">
                            <div class="mb-2"></div>
                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{session('error')}}
                                </div>
                            @endif
                                <h4 class="text-center">Log in with:</h4>
                                <div class="d.grid gap-2 d-md-flex justify-content-center">
                                </div>
                                <form action="{{route('login')}}" method="POST" class="form-signin">
                                    @csrf
                                    <div class="d-grid text-center">
                                        <a href="{{route('auth', ['provider' => 'google'])}}" class="btn btn-lg btn-danger btn-login text-uppercase fw-bold mb-2"><i class="fab fa-google"></i> Google</a>
                                    </div>
                                    <div class="d-grid text-center">
                                        <a href="{{route('auth', ['provider' => 'facebook'])}}" class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2"><i class="fab fa-facebook-f"></i> Facebook</a>
                                    </div>
                                    <div class="d-grid text-center">
                                        <a href="{{route('auth', ['provider' => 'Microsoft'])}}" class="btn btn-lg btn-info btn-login text-uppercase fw-bold mb-2"><i class="fab fa-microsoft"></i> Microsoft</a>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>
@endsection

{{-- @extends('layout')
{{--     <form action="{{route('participacions')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form> --}}