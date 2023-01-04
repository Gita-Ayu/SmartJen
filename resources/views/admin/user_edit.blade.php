@extends('admin.layouts.template')
@section('CONTENT')
<form action="{{ route('admin.user.update') }}/{{ $user->user_id }}" method="post">
@csrf
    @method('PUT')
<div class="row mt-5 mx-auto" style="max-width: 720px;">
    <div class="col-12">
        <h2>Edit User {{ $user->user_name }}</h2>
        <hr class="my-3">
    </div>
    <div class="col-md-6 mt-2">
        <label for="user_name" class="form-label">Invitee Name</label>
        <input type="text" name="user_name" value="{{ old('user_name', $user->user_name) }}" class="form-control {{ $errors->has('user_name') ? 'is-invalid' : '' }}">
        @if($errors->has('user_name'))
            <div class="invalid-feedback">{{ $errors->first('user_name') }}</div>
        @endif
    </div>
    <div class="col-md-6 mt-2">
        <label for="user_email" class="form-label">invitee Email</label>
        <input type="text" name="user_email" value="{{ old('user_email', $user->user_email) }}" class="form-control {{ $errors->has('user_email') ? 'is-invalid' : '' }}">
        @if($errors->has('user_email'))
            <div class="invalid-feedback">{{ $errors->first('user_email') }}</div>
        @endif
    </div>
    <div class="col-md-12 mt-2">
        <label for="user_role" class="form-label">Invitee Role</label>
        <select name="user_role" class="form-control">
            <option value="teacher"@if($user->user_role == 'teacher') {{ 'selected' }}@endif>Teacher</option>
            <option value="student"@if($user->user_role == 'student') {{ 'selected' }}@endif>Student</option>
        </select>
        @if($errors->has('user_role'))
            <div class="invalid-feedback">{{ $errors->first('user_role') }}</div>
        @endif
    </div>
    <div class="col-md-12 text-center mt-5">
        <button type="submit" class="btn btn-lg btn-primary w-50">Update</button>
    </div>
</div>
</form>
@endsection