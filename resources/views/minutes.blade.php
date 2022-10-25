<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Minutes</title>
    <link href="/dist/css/admin.css" rel="stylesheet">
</head>
<body>
    <h1 class="h1-minutes">
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
    <table class="minutes">
        @for ($t = 0; $t<20; $t++)
            <tr>
                @for ( $c=0; $c < 3 ; $c++ )
                <td>
                    <?php $m = $t + $c*20 ; ?>
                    @if ( isset($minutes[$m]) )
                        <a href="{{ '/minute/'.$hour.'/'.$m }}"><b>{{$m}}</b></a> </td><td><b>{{ $minutes[$m] }}</b>
                    @else
                        <span class="miss">{{ $m }}</span> </td><td>0
                    @endif
                </td>
                @endfor
            </tr>
        @endfor
    </table>

    <h1 class="h1-minutes"><a href="/list">&lt; Back &lt;</a></h1>
</body>
</html>