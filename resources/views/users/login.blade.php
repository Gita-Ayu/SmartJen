@extends('users.layouts.template')
@section('CONTENT')
<form action="{{ route('users.authenticate') }}" method="post">
@csrf
<div class="row mt-5 mx-auto" style="max-width: 720px;">
    <div class="col-12">
        <h2>User Login</h2>
        <hr class="my-3">
    </div>
    <div class="col-md-12 mt-2">
        <label for="user_email" class="form-label">Email</label>
        <input type="text" name="user_email" value="{{ old('user_email') }}" class="form-control {{ $errors->has('user_email') ? 'is-invalid' : '' }}">
        @if($errors->has('user_email'))
            <div class="invalid-feedback">{{ $errors->first('user_email') }}</div>
        @endif
    </div>
    <div class="col-md-12 mt-2">
        <label for="password" class="form-label">Password</label>
        <input type="text" name="password" value="{{ old('user_password') }}" class="form-control {{ $errors->has('user_password') ? 'is-invalid' : '' }}">
        @if($errors->has('user_password'))
            <div class="invalid-feedback">{{ $errors->first('user_password') }}</div>
        @endif
    </div>
    <div class="col-md-12 text-center mt-5">
        <button type="submit" class="btn btn-lg btn-primary w-50">Login</button>
    </div>
</div>
</form>
@endsection