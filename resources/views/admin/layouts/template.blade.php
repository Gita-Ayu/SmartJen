<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="N/A">
    <meta name="generator" content="Laravel 8.5">
    <title>@if(isset($title)){{$title.' | SmartJen'}} @else {{ 'SmartJen' }}@endif</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body class="bg-light">
<header class="p-3 bg-primary text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="{{ route('web.home') }}" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <h2 class="pr-xl-2">Smartjen</h2>
            </a>
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{ route('admin.home') }}" class="nav-link px-2 text-white">Dashboard</a></li>
                <li><a href="{{ route('admin.user.invitation') }}" class="nav-link px-2 text-white">Invite User</a></li>
            </ul>
            @auth('school')
            <div class="text-end">
                <a href="{{route('admin.logout')}}">
                    <button type="button" class="btn btn-outline-light me-2">LOGOUT</button>
                </a>
            </div>
            @endauth
            @guest('school')
            <div class="text-end">
                <a href="{{ route('admin.login') }}">
                    <button type="button" class="btn btn-outline-light me-2">LOGIN</button>
                </a>
                <a href="{{ route('admin.signup') }}">
                    <button type="button" class="btn btn-warning">SIGN-UP</button>
                </a>
            </div>
            @endguest
        </div>
    </div>
</header>
<div class="container py-5" style="min-height: 80vh; ">
<!-- CONTENT -->
@yield('CONTENT')
<!-- CONTENT -->
</div>
<div class="bg-black text-white">
<footer class="text-center text-small py-5">
    <p class="mb-1">&copy; 2021 SmartJen</p>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/scripts.js')}}"></script>
</body>
</html>
