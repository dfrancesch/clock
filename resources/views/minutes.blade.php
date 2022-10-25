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
h1 {
    text-align: center;
}
</style>
</head>
<body>
    <h1>
        @if ( $hour > 0 )
            <a href="{{ '/hour/'.($hour-1) }}">&lt;&lt;</a>
        @else
            &lt;&lt;
        @endif 
        Hour {{ $hour }}
        @if ( $hour < 23 )
            <a href="{{ '/hour/'.($hour+1) }}">&gt;&gt;</a>
        @else
            &gt;&gt;
        @endif 
    </h1>
    <table>
        <?php
            for ($t = 0; $t<20; $t++) {
        ?>
            <tr>
                <td>
                    @if ( isset($minutes[$t]) )
                        <a href="{{ '/minute/'.$hour.'/'.$t }}"><b>{{$t}}</b></a> </td><td><b>{{ $minutes[$t] }}</b>
                    @else
                        {{ $t }} </td><td>0
                    @endif
                </td>
                <td>
                    @if ( isset($minutes[$t+20]) )
                        <a href="{{ '/minute/'.$hour.'/'.($t+20) }}"><b>{{$t+20}}</b></a> </td><td><b>{{ $minutes[$t+20] }}</b>
                    @else
                        {{ $t+20 }} </td><td>0
                    @endif
                </td>
                <td>
                    @if ( isset($minutes[$t+40]) )
                        <a href="{{ '/minute/'.$hour.'/'.($t+40) }}"><b>{{$t+40}}</b></a> </td><td><b>{{ $minutes[$t+40] }}</b>
                    @else
                        {{ $t+40 }} </td><td>0
                    @endif
                </td>
            </tr>
        <?php
            }
        ?>
    </table>

    <h1><a href="/list">&lt; Back &lt;</a></h1>
</body>
</html>