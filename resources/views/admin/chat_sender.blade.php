<input type="text" name="message" id="message" placeholder="Message" style="width:50%; padding: 20px;"><input type="submit" value="SEND" onclick="sendPusherMessage('{{ route('pusher') }}','smartjen','smartjen','message');">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    function sendPusherMessage(URL,channelName,eventName,msgFieldId)
    {
        $.post(URL,
            {
                channel: channelName,
                event: eventName,
                message: $("#"+msgFieldId).val()
            });
        $("#"+msgFieldId).val('');
        return false;
    }
</script>