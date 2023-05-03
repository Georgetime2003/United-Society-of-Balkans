<!DOCTYPE html>
<html lang="ca-es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>USB</title>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/login.css') }}">
    <script src="{{ asset ('js/jquery.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <link type="text/css" rel="stylesheet" href="{{ asset('fontawesome/css/brands.css')}}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ asset('fontawesome/css/solid.css')}}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ asset('fontawesome/css/fontawesome.css')}}" rel="stylesheet">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <link rel="icon" sizes="960x960" href="{{ asset('images/logo.png') }}">
    <link rel="icon" type="image/png" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
<script>
        if (navigator.userAgent.match(/Android/i)) {
            window.scrollTo(0,0); // reset in case prev not scrolled  
            var nPageH = $(document).height();
            var nViewH = window.outerHeight;
            if (nViewH > nPageH) {
              nViewH -= 250;
              $('BODY').css('height',nViewH + 'px');
            }
            window.scrollTo(0,1);
        } else if (navigator.userAgent.match(/iPhone/i)) {
            window.scrollTo(0,0); // reset in case prev not scrolled  
            var nPageH = $(document).height();
            var nViewH = window.outerHeight;
            if (nViewH > nPageH) {
              nViewH -= 250;
              $('BODY').css('height',nViewH + 'px');
            }
            window.scrollTo(0,1);
        } else if (navigator.userAgent.match(/iPad/i)) {
            window.scrollTo(0,0); // reset in case prev not scrolled  
            var nPageH = $(document).height();
            var nViewH = window.outerHeight;
            if (nViewH > nPageH) {
              nViewH -= 250;
              $('BODY').css('height',nViewH + 'px');
            }
            window.scrollTo(0,1);
        }
    </script>
    @yield('header')
</head>
<body>
    @yield('content')
</body>
</html>
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

{{-- @extends('layout')
{{--     <form action="{{route('participacions')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form> --}}