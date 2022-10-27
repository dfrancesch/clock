/*
Clock
*/

// const { get } = require("lodash");

colors = [
    '#e57575',
    '#c29a1a',
    '#acc21a',
    '#3ec21a',
    '#1ac27c',
    '#28c6b3',
    '#2887c6',
    '#8377c8',
    '#3517df',
    '#c417df',
    '#df17a6',
    '#df5017',
    '#e90000',
]
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
            cl = Math.floor(Math.random() * colors.length );
            $('#clock').css("color", colors[cl]);
            show_time = time.substr(0,2)+':'+time.substr(-2);
            $('#clock').text(show_time);


            $('#clock-detail').text("Automatically Generated Image Time");
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

