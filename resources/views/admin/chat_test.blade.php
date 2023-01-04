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
        // bind event here
        channel.bind('event-290980630429', function(data) {
            alert(JSON.stringify(data));
            let elem = document.getElementById('listen');
            elem.innerHTML += data.message+'<br>';
        });
    </script>
    <h1>Pusher Test</h1>
    <p>
        Try publishing an event to channel <code>my-channel</code>
        with event name <code>my-event</code>.
    <div id="listen"></div>
    </p>
@endsection
