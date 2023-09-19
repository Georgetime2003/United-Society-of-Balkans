<!DOCTYPE html>
<html lang="ca-es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>USB</title>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/main.css') }}">
    <script src="{{ asset ('js/jquery.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.min.js')}}"></script>
    <link type="text/css" rel="stylesheet" href="{{ asset('fontawesome/css/brands.css')}}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ asset('fontawesome/css/solid.css')}}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ asset('fontawesome/css/fontawesome.css')}}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <link rel="icon" sizes="960x960" href="{{ asset('images/logo.png') }}">
    <link rel="icon" type="image/png" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
    @laravelPWA
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>

    <script>
        const firebaseConfig = {
          apiKey: "AIzaSyA4HXAh025iWSPFHwFrbI-6CrVzHgcfuvU",
          authDomain: "usob-387217.firebaseapp.com",
          projectId: "usob-387217",
          storageBucket: "usob-387217.appspot.com",
          messagingSenderId: "567094647866",
          appId: "1:567094647866:web:6943ea3d04f54af238a903"
        };

        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();

        function initFirebaseMessagingRegistration() {
            messaging.requestPermission().then(function () {
            return messaging.getToken()
        }).then(function(token) {
        
        axios.post("{{ route('fcmToken') }}",{
            _method:"PATCH",
            token
        }).then(({data})=>{
            console.log(data)
        }).catch(({response:{data}})=>{
            console.error(data)
        })

    }).catch(function (err) {
        console.log(`Token Error :: ${err}`);
    });
}

initFirebaseMessagingRegistration();

messaging.onMessage(function({data:{body,title}}){
    new Notification(title, {body});
});
    </script>
    @yield('header')
</head>
<body>
    @yield('content')
</body>
</html>