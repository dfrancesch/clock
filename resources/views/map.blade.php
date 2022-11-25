<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Album</title>
    <link href="/dist/css/admin.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
        crossorigin=""/>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
        crossorigin=""></script>
<style>
html, body {
    height: 100%;
}
.leaflet-container {
    position:fixed;
    padding:0;
    margin:0;

    top:0;
    left:0;

    width: 100%;
    height: 100%;
}

</style>
</head>
<body>
    <div id="map" class="leaflet-container"></div>
<script>

    const gps= @json( $gps ) ;

    const map = L.map('map').setView([-34.61, -58.449], 12);

	const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 19,
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(map);

    gps.forEach(element => {
        L.marker([element.latitude, element.longitude])
            .addTo(map)
            .bindPopup('<img src="'+element.picture+'" width="100">');
    });
    /*
    var marker = L.marker([-34.61, -58.449]).addTo(map);

    setTimeout(() => {
        marker.remove();
        marker = L.marker([-34.62, -58.43]).addTo(map);
        map.setView([-34.62, -58.43]);
    }, 1000);
*/
</script>
</body>
</html>