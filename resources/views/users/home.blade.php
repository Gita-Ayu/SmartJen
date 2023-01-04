@extends('users.layouts.template')
@section('CONTENT')
@auth('users')
    <h3><strong>Welcome Back {{ Auth::guard('users')->user()->user_name }}!</strong></h3>
    <h5 class="mt-3">School: {{ ucwords($school->school_name) }}</h5>
    <h5>Status: {{ ucwords(Auth::guard('users')->user()->user_role) }}</h5>
    <hr>
@endauth
@endsection