@extends('admin.layout')

@section('title', 'Mapa')

@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
        crossorigin=""/>

    <style>
        #map {
            width: 100%;
            height: calc(100vh - 150px);
            min-height: 400px;
        }
    </style>

    <div class="row">
        <div class="col-12">
            <h1 class="h4 mb-3">Mapa</h1>
        </div>
    </div>

    <div id="map"></div>

    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
        crossorigin=""></script>

    <script>
        const gps = @json($gps);

        const map = L.map('map').setView([-34.61, -58.449], 12);

        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        gps.forEach(element => {
            L.marker([element.latitude, element.longitude])
                .addTo(map)
                .bindPopup('<img src="' + element.picture + '" width="100">');
        });
    </script>
@endsection