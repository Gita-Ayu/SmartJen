@extends('admin.layouts.template')
@section('CONTENT')
@auth('school')
    <h3><strong>{{ Auth::guard('school')->user()->school_name }}</strong></h3>
@endauth
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-5">
                <h4>Teachers</h4>
                <hr>
                <div style="max-width: 360px">
                    @foreach($teachers as $teacher)
                        <div class="d-flex py-2 border-bottom">{{ $teacher->user_name }}
                            <div class="ms-auto">
                                <button type="submit" onclick="window.location.href='{{ route('admin.user.edit') }}/{{ $teacher->user_id }}'" class="btn btn-primary btn-sm">Edit</button>
                                <button type="submit" onclick="window.location.href='{{ route('admin.user.chat') }}/{{ $teacher->user_id }}'"class="btn btn-success btn-sm">Chat</button>
                                <button type="submit" onclick="deleteConfirm('{{ route('admin.user.delete') }}/{{ $teacher->user_id }}','{{ $teacher->user_name }}')" class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6 mb-5">
                <h4>Students</h4>
                <hr>
                <div style="max-width: 360px">
                @foreach($students as $student)
                    <div class="d-flex py-2 border-bottom">{{ $student->user_name }}
                        <div class="ms-auto" style="max-width: 300px;">
                            <button type="submit" onclick="window.location.href='{{ route('admin.user.edit') }}/{{ $student->user_id }}'" class="btn btn-primary btn-sm">Edit</button>
                            <button type="submit" onclick="deleteConfirm('{{ route('admin.user.delete') }}/{{ $student->user_id }}','{{ $student->user_name }}')" class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection