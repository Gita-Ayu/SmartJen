@extends('admin.layouts.template')
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
        channel.bind('event-{{ Auth::guard('school')->id() }}', function(data) {
            let elem = document.getElementById('listen');
            let time = today.getHours() + ":" + today.getMinutes();
            let elem = document.getElementById('listen');
            elem.innerHTML += '<strong>[' + time + '] {{ $user['user_name'] }}</strong>: ' + data.message + '<br>';
        });
    </script>
    <h3><strong>Chating with {{ $user->user_name }}</strong></h3>
    <hr class="my-5">
    <form onsubmit="return sendPusherMessage('{{ route('pusher') }}','smartjen','event-{{ $user->user_id }}','message','Me: ');">
        <div class="row">
            <div class="col-md-6 offset-md-2">
                <div id="listen"></div>
                <div>
                    <input type="text" name="message" id="message" placeholder="Message" class="form-control mt-3">
                </div>
                <div class="text-center">
                    <button class="btn btn-primary btn-sm mt-3" style="width: 200px; padding: 12px;" type="submit">SEND MESSAGE</button>
                </div>
            </div>
        </div>
    </form>
@endsection