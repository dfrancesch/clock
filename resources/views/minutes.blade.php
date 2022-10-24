<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Minutes</title>
<style>
body {
    font-size: 20px;
}
table {
    width: 100%;
}
td {
    text-align: right;
    border: 1px solid black;
    padding: 4px;
    width: 16.66%;
}
</style>
</head>
<body>
    <h1>Minutes for {{ $hour }}</h1>
    <table>
        <?php
            for ($t = 0; $t<20; $t++) {
        ?>
            <tr>
                <td>
                    @if ( isset($minutes[$t]) )
                        <a href="{{ '/minute/'.$hour.'/'.$t }}">{{$t}}</a> </td><td>{{ $minutes[$t] }}
                    @else
                        {{ $t }} </td><td>0
                    @endif
                </td>
                <td>
                    @if ( isset($minutes[$t+20]) )
                        <a href="{{ '/minute/'.$hour.'/'.($t+20) }}">{{$t+20}}</a> </td><td>{{ $minutes[$t+20] }}
                    @else
                        {{ $t+20 }} </td><td>0
                    @endif
                </td>
                <td>
                    @if ( isset($minutes[$t+40]) )
                        <a href="{{ '/minute/'.$hour.'/'.($t+40) }}">{{$t+40}}</a> </td><td>{{ $minutes[$t+40] }}
                    @else
                        {{ $t+40 }} </td><td>0
                    @endif
                </td>
            </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>