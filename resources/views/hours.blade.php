<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="/dist/css/admin.css" rel="stylesheet">
    
</head>
<body>
    <h1>Hours</h1>
    <table class="hours">
        @for ($t = 0; $t<12; $t++) 
            <tr>
                @for ( $c = 0; $c<2; $c++)
                <td>
                    <?php $h = $t + $c * 12; ?>
                    @if ( isset($hours[$h]) )
                        <a href="{{ '/hour/'.$h }}"><b>{{$h}}</b></a> </td><td><b>{{ $hours[$h] }}</b>
                    @else
                        <span class="miss">{{ $h }}</span></td><td>0
                    @endif
                </td>
                @endfor
            </tr>
        @endfor
    </table>
</body>
</html>