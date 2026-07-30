<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa StreetMap</title>

    <link rel="stylesheet"
          href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        body{
            margin:0;
            font-family: Arial, sans-serif;
        }

        header{
            background:#0d6efd;
            color:white;
            text-align:center;
            padding:20px;
            font-size:30px;
            font-weight:bold;
        }

        #map {
            height: 600px;
            width: 100%;
        }
    </style>
</head>
<body>

    <header>
        SMART WEB
    </header>

    <div id="map"></div>

    <script src="https://unpkg.com/leaflet@1.9.t.js"></script>

    <script>
        const map = L.map('map').setView([19.4326, -99.1332], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 90,
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        L.marker([19.4326, -99.1332])
            .addTo(map)
            .bindPopup('Ciudad de México')
            .openPopup();
    </script>

</body>
</html>