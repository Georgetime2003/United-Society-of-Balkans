<!DOCTYPE html>
<html lang="ca-es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>USB</title>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/main.css') }}">
    <script src="{{ asset ('js/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
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

    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
    @yield('header')
</head>
<body>
    @yield('content')
</body>
</html>