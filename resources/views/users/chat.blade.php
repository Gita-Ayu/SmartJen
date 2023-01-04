@extends('users.layouts.template')
@section('CONTENT')
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;
        var pusher = new Pusher('76dd39ffd41c9387d417', {
            cluster: 'ap1'
        });
        var channel = pusher.subscribe('smartjen');
        // bind event here with user id
        channel.bind('event-{{ Auth::guard('users')->id() }}', function(data) {
            let today = new Date();
            let time = today.getHours() + ":" + today.getMinutes();
            let elem = document.getElementById('listen');
            elem.innerHTML += '<strong>[' + time + '] School</strong>: ' + data.message + '<br>';
        });
    </script>
    <h3>Chating with {{ $admin['school_name'] }}</h3>
    <hr class="my-5">
    <form onsubmit="return sendPusherMessage('{{ route('pusher') }}','smartjen','event-{{ $admin['school_admin_id'] }}','message','Me: ');">
    <div class="row">
        <div class="col-md-6 offset-md-2">
            <div id="listen" class="mt-5"></div>
            <div>
                <input type="text" name="message" id="message" placeholder="Message" class="form-control mt-3">
            </div>
            <div class="text-center">
                <button class="btn btn-primary btn-sm mt-3" style="width: 200px; padding: 12px;" type="submit" onclick="/*sendPusherMessage('{{ route('pusher') }}','smartjen','event-{{ $admin['school_admin_id'] }}','message','Me: ');*/">SEND MESSAGE</button>
            </div>
        </div>
    </div>
    </form>
@endsection
