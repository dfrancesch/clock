<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clock</title>

    <!-- Bootstrap 5.2.2 -->
    <link href="/dist/bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="/dist/css/clock.css" rel="stylesheet">

    <script src="/dist/js/jquery-3.6.1.min.js"></script>
    <script src="/dist/js/clock.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
    <h1>Address Clock</h1>
    <div id="clock"></div>
    <div id="clock-detail"></div>

    <!-- JavaScript Bundle with Popper -->
    <script src="/dist/bootstrap/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

@if (isset($time))
<script>
    $(document).ready( function () {
        setTime('{{ $time }}');
    });
</script>
@else
<script>
    $(document).ready( function () {
        clockOn();
    });
</script>    
@endif
    </div>
</body>
</html>