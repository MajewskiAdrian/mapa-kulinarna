<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa kulinarna</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" crossorigin="" />
    <link rel="stylesheet" href="style/main.css">
    <style>
        #map {
            height: 600px;
            width: 70%;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" crossorigin=""></script>
    <script>
        var map = L.map('map', {
            center: [20, 0], // Ustawienie początkowej pozycji mapy
            zoom: 2, // Początkowy poziom zoomu
            minZoom: 1.85, // Minimalny poziom zoomu, zapobiega oddaleniu mapy zbyt mocno
            maxZoom: 6, // Maksymalny poziom zoomu, aby nie dało się przybliżyć za bardzo
            maxBounds: [
                [-90, -180], // Lewy dolny róg mapy (maksymalnie na południe i na zachód)
                [90, 180] // Prawy górny róg mapy (maksymalnie na północ i na wschód)
            ] // Ogranicza obszar mapy, aby nie można było jej przesunąć poza określony obszar
        }).setView([20, 0], 2); // Początkowy widok mapy

        L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/dark_all/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);
    </script>
</body>

</html>