<?php
require_once "includes/db_conn.php";
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa kulinarna</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" crossorigin="" />
    <link rel="stylesheet" href="style/main.css">
</head>

<body>
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" crossorigin=""></script>
    <script>
        var map = L.map('map', {
            center: [20, 0], // początkowej pozycja mapy
            zoom: 2, // początkowy zoom
            minZoom: 1.85, // min zoom
            maxZoom: 6, // max zoom
            maxBounds: [
                [-90, -180], // border (maksymalnie na południe i na zachód)
                [90, 180] // border (maksymalnie na północ i na wschód)
            ] // ogólnie sprawia żeby nie można było wyjechać poza określony obszar
        })
        L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/dark_all/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);
    </script>
    <?php
    $sql = "SELECT nazwa_restauracji,panstwo,miasto,ulica FROM restauracje;";
    $result = $conn->query($sql);
    echo '<div class="restauracje-container">';
    if ($result->num_rows > 0) {
    
        while($row = $result->fetch_assoc()) {
            echo '<div class="restuaracja-box">';
            echo "<p class='restauracja-nazwa'>" . $row["nazwa_restauracji"]."</p>";
            echo '<span  class="restauracja-dane">';
            echo "Państwo: " . $row["panstwo"]."<br>";
            echo "Adres: " . $row["ulica"].', '.$row["miasto"]."";
            echo '</span>';
            echo '</div>';
        }
    } else {
        echo "Brak wyników.";
    }
    echo '</div>';
    ?>
</body>

</html>