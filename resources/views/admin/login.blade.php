@extends('admin.layouts.template')
@section('CONTENT')
<form action="{{ route('admin.authenticate') }}" method="post">
@csrf
<div class="row mt-5 mx-auto" style="max-width: 720px;">
    <div class="col-12">
        <h2>School Admin Login</h2>
        <hr class="my-3">
    </div>
    <div class="col-md-12 mt-2">
        <label for="email" class="form-label">Email</label>
        <input type="text" name="email" value="{{ old('email') }}" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">
        @if($errors->has('email'))
            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
        @endif
    </div>
    <div class="col-md-12 mt-2">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" value="{{ old('password') }}" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
        @if($errors->has('password'))
            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
        @endif
    </div>
    <div class="col-md-12 text-center mt-5">
        <button type="submit" class="btn btn-lg btn-primary w-50">Login</button>
    </div>
</div>
</form>
@endsection