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
    <div class="container bb ">
        <div class="row justify-content-md-center">
            <div class="col-lg-8 col-md-12 bb">
                <div class="card" >
                    <div class="card-body">
                        <h1>Address Clock</h1>
                    </div>
                  </div>
                <div class="clock-container">
                <div id="clock" class="card bb"></div> 
                </div>
                <!-- <img id="clock_img" src="/storage/times/1949-2.jpg" class="rounded mx-auto d-block" style="width: 100%;" alt="..."> -->
                <div class="card" >
                    <div class="card-body" id="clock-detail">
                    </div>
                </div>
            </div>
        </div>
    </div>

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
</body>
</html>