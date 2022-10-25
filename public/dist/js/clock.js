/*
Clock
*/

// const { get } = require("lodash");

function setTime( time ) {
    var settings = {
        "url": window.location.origin + "/api/v1/time/" + time,
        "method": "GET",
        "timeout": 0,
        "headers": {
        },
    };

    $.ajax(settings).done(function (response) {
        console.log(response);
        if ( response.length == 0 ) {
            $('#clock').css("background-image", "");
            show_time = time.substr(0,2)+':'+time.substr(-2);
            $('#clock').text(show_time);

            $('#clock-detail').text("");
        } else {
            pos = Math.floor( Math.random()* response.length );
            $('#clock').css("background-image", "url(" + response[pos].picture + ")");
            $('#clock').text('');

            txt = '<span class="user">'+response[pos].user.nick_name + " from " + response[pos].country + '</span>';
            txt += '<br>';
            txt += response[pos].description;
            $('#clock-detail').html(txt);

        }
    });
  
}

function clockOn() {
    lasttime = '';
    setInterval( function() {
        d = new Date();
        // console.log(d);
        actual_time = ('0'+d.getHours()).substr(-2) + ('0'+d.getMinutes()).substr(-2) ;
        if ( lasttime != actual_time ) {
            console.log(actual_time);
            lasttime = actual_time;
            setTime(actual_time);
        }
    }, 1000);    
}

