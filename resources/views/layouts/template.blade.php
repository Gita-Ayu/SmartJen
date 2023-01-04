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
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <h2 class="pr-xl-2">Smartjen</h2>
            </a>
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li>&nbsp;</li>
            </ul>
            <div class="text-end">
                <a href="{{ route('users.login') }}">
                    <button type="button" class="btn btn-outline-light me-2">USER LOGIN</button>
                </a>
                <a href="{{ route('admin.login') }}">
                    <button type="button" class="btn btn-outline-light me-2">ADMIN LOGIN</button>
                </a>
                <a href="{{ route('admin.signup') }}">
                    <button type="button" class="btn btn-warning">SCHOOL SIGNUP</button>
                </a>
            </div>
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
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
