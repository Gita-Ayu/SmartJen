@extends('admin.layouts.template')
@section('CONTENT')
<h3 class="text-center" style="margin-top: 30vh;">{{session('message')}}</h3>
    <div class="text-center">
        <a href="{{ route('admin.home') }}">
            <button type="submit" class="btn btn-primary">Home</button>
        </a>
    </div>
@endsection