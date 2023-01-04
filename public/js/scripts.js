//  JavaScript Document

    function deleteConfirm(url, userName)
    {
        let action = confirm('Do you want to delete ' + userName + ' ?');
        if(action == true) window.location.href = url;
        else return false
    }

    function sendPusherMessage(URL,channelName,eventName,msgFieldId,chatLabel)
    {
        let txtField = $("#"+msgFieldId);
        let fieldValue = txtField.val();
        let today = new Date();
        let time = today.getHours() + ":" + today.getMinutes()
        $.post(URL,
            {
                channel: channelName,
                event: eventName,
                message: fieldValue
            });
        let listener = $('#listen');
        listener.html(listener.html() + '<strong>[' + time + '] ' + chatLabel + '</strong> '+ fieldValue + '<br>');

        txtField.val('');
        return false;
    }
