<?php
require_once "includes/db_conn.php";
session_start();
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
    <form action="" method="post">
        <button type="submit" name="panstwo" value="Polska"> Polska </button>
        <button type="submit" name="panstwo" value="Włochy"> Włochy </button>
    </form>


    
    <?php
    echo '<div class="restauracje-container">';
    if (isset($_POST["panstwo"])) {
        $panstwo = $_POST['panstwo'];
        $_SESSION['panstwo'] = $panstwo;
    }
    
    if (isset($_SESSION["panstwo"])) {

    

        $nazwaPanstwa = $_SESSION['panstwo'];
        $sql = "SELECT * FROM restauracje WHERE panstwo = '" . $nazwaPanstwa . "';";
        $result = $conn->query($sql);

        
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $idRestauracji = $row["id"];
                echo '<div class="restuaracja-box">';
                echo "<p class='restauracja-nazwa'>" . $row["nazwa_restauracji"] . "</p>";
                echo '<span class="restauracja-dane">';
                echo "Państwo: " . $row["panstwo"] . "<br>";
                echo "Adres: " . $row["ulica"] . ', ' . $row["miasto"] . "";
                echo '</span>';
                echo '</div>';
                echo '<form action="" method="POST">';
                echo "<input type='submit' name='restauracja-button' value='$idRestauracji'>";
                echo '</form>';
            }
        } else {
            echo "Brak wyników.";
        }
        echo '</div>';
    }

        // WYŚWIETLANIE DAŃ
        if (isset($_POST['restauracja-button'])) {
            $idRestauracji = $_POST['restauracja-button'];
            $_SESSION['idRestauracji'] = $idRestauracji;
        }

        if (isset($_SESSION['idRestauracji'])) {
            $idRestauracji = $_POST['restauracja-button'];

            echo '<div class="dania-container">';
            echo "$idRestauracji";
            echo '</div>';
            unset($_SESSION['idRestauracji']);
        }
            /*$sql = "SELECT * FROM dania WHERE id_restauracji = '" . $idRestauracji . "';";
            $result = $conn->query($sql);
            echo '<div class="restauracje-container">';
            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    echo '<div class="restuaracja-box">';
                    echo "<p class='restauracja-nazwa'>" . $row["nazwa_dania"] . "</p>";
                    echo '<span  class="restauracja-dane">';
                    echo "Państwo: " . $row["opis"] . "<br>";
                    echo "Adres: " . $row["wegetarianskie"] . ', ' . $row["kuchnia"] . "";
                    echo '</span>';
                    echo '</div>';
                }
            } else {
                echo "Brak wyników.";
            }
            echo '</div>';
        }*/

    



    ?>
</body>

</html>