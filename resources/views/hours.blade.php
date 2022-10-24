<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
    width: 25%;
}
</style>
</head>
<body>
    <h1>Hours</h1>
    <table>
        <?php
            for ($t = 0; $t<12; $t++) {
        ?>
            <tr>
                <td>
                    @if ( isset($hours[$t]) )
                        <a href="{{ '/hour/'.$t }}">{{$t}}</a> </td><td>{{ $hours[$t] }}
                    @else
                        {{ $t }} </td><td>0
                    @endif
                </td>
                <td>
                    @if ( isset($hours[$t+12]) )
                        <a href="{{ '/hour/'.($t+12) }}">{{$t+12}}</a> </td><td>{{ $hours[$t+12] }}
                    @else
                        {{ $t+12 }} </td><td>0
                    @endif
                </td>
            </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>