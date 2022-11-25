<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clock</title>

    <!-- Bootstrap 5.2.2 -->
    <link href="/dist/bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
        crossorigin=""/>
    <link href="/dist/css/clock.css" rel="stylesheet">

    <script src="/dist/js/jquery-3.6.1.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
        crossorigin=""></script>

    <script src="/dist/js/clock.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container bb ">
        <nav class="navbar fixed-top navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">Address Clock</a>
                {{-- 
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                        <a class="nav-link" href="#">Features</a>
                        <a class="nav-link" href="#">Pricing</a>
                        <a class="nav-link disabled">Disabled</a>
                    </div>
                </div>
                --}}
            </div>
        </nav>
        <div class="row justify-content-md-center">
            <div class="col-lg-6 col-md-12">
                <div class="clock-container">
                    <div id="clock" class="card bb"></div> 
                </div>
            </div>
            <div class="col-lg-6 col-md-12 bb">
                <div class="card" >
                    <div class="card-body" >
                        <div id="map" class="mapframe"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 bb">
                <div class="card" >
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-9 col-md-12">
                                <div id="clock-detail">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12 text-end">
                                <?php
                                    $q = App\Http\Controllers\TimeController::getCount();
                                ?>
                                Pictures: {{ $q }} of 1440<br>% {{ sprintf("%2.2f", ( $q / 1440 * 100 )) }}
                            </div>
                        </div>
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

    <script>

        const map = L.map('map').setView([-34.61, -58.449], 12);
    
        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

    </script>
    
</body>
</html>