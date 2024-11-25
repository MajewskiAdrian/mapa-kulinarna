<?php
require_once "includes/db_conn.php";
session_start();

if (!isset($_COOKIE['liczba_odwiedzin'])) {
    setcookie('liczba_odwiedzin', 1, time() + 60 * 60 * 24 * 7);
    $liczba_odwiedzin = 1;
} else if (!isset($_SESSION['wizyta_sesji'])) {
    $liczba_odwiedzin = $_COOKIE['liczba_odwiedzin'] + 1;
    setcookie('liczba_odwiedzin', $liczba_odwiedzin, time() + 60 * 60 * 24 * 7);
}


?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa kulinarna</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" crossorigin="" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="style/main.css">

</head>

<body>
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" crossorigin=""></script>
    <script>
        var map = L.map('map', {
            center: [20, 0], // początkowej pozycja mapy
            zoom: 2, // początkowy zoom
            minZoom: 2.4, // min zoom
            maxZoom: 6, // max zoom
            maxBounds: [
                [-90, -180], // border (maksymalnie na południe i na zachód)
                [90, 180] // border (maksymalnie na północ i na wschód)
            ] // ogólnie sprawia żeby nie można było wyjechać poza określony obszar
        })
        L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/dark_all/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        fetch("countries-medium.json")
            .then(response => response.json())
            .then(data => {
                // Dodanie warstwy GeoJSON do mapy
                L.geoJSON(data, {
                    style: {
                        color: "#ff7800",
                        weight: 1,
                        opacity: 0.65
                    },
                    onEachFeature: function (feature, layer) {
                        layer.on('click', function (e) {
                            let countryName = feature.properties.name_pl;
                            window.location.href = `index.php?country=${encodeURIComponent(countryName)}`;
                        });
                    }
                }).addTo(map);
            })
            .catch(error => console.error('Błąd ładowania GeoJSON:', error));

    </script>

    <?php
    if (!isset($_SESSION['wybor'])) {
        $_SESSION['wybor'] = "restauracje";
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['wybor'])) {
        if ($_POST['wybor'] === "restauracje") {
            $_SESSION['wybor'] = "dania";
            $_SESSION['restauracje'] = true;
        } else {
            $_SESSION['wybor'] = "restauracje";
            $_SESSION['restauracje'] = false;
        }

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
    $wybor = $_SESSION['wybor'];

    echo '<form action="" method="post">';
    echo '<button type="submit" class="button-wybor-'. $wybor .'" name="wybor" value="' . $wybor . '">' . $wybor . '</button>';
    echo '</form>';

    ?>


    <?php
    if (isset($_GET['country'])) {
        $panstwo = $_GET['country'];
        echo "Państwo: " . htmlspecialchars($panstwo);
        $_SESSION['panstwo'] = $panstwo;
    }


    

    if (isset($_SESSION["panstwo"])) {
        $nazwaPanstwa = $_SESSION['panstwo'];

        // GUZIK DO DANIA/RESTAURACJE (if/else)
        if (isset($_SESSION["restauracje"]) && $_SESSION["restauracje"]) {
            echo '<div class="restauracje-container">';
            $sql = "SELECT * FROM restauracje WHERE panstwo = '" . $nazwaPanstwa . "';";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    $idRestauracji = $row["id"];
                    echo '<form action="" method="POST">';
                    echo '<button type="submit" class="button-restauracja" name="restauracja-button" value="' . $idRestauracji . '">';
                    echo '<div class="restuaracja-box">';
                    echo "<p class='restauracja-nazwa'>" . $row["nazwa_restauracji"] . "</p>";
                    echo '<span class="restauracja-dane">';
                    echo "Państwo: " . $row["panstwo"] . "<br>";
                    echo "Adres: " . $row["ulica"] . ', ' . $row["miasto"] . "";
                    echo '</span>';
                    echo '</div>';
                    echo '</button>';
                    echo '</form>';
                }
            } else {
                echo "Brak wyników.";
                unset($_POST['restauracja-button']);
            }
            echo '</div>';
            
            // DANIA
        } else {
            // wybranie id restauracji z wybranego państwa
            $sql = "SELECT id FROM restauracje WHERE panstwo='" . $_SESSION['panstwo'] . "';";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $idRestauracji = [];
                while ($row = $result->fetch_assoc()) {
                    $idRestauracji[] = $row["id"];
                }
            } else {
                echo '<div class="restauracje-container">';
                echo "Brak wyników";
                echo '</div>';
                die();
            }
            
            // wybieranie id dań z danej restauracji z danego państwa
            $sql = "SELECT id_dania FROM restauracje_dania WHERE id_restauracji IN(" . implode(", ",$idRestauracji) . ");";
            
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $idDan = [];
                while ($row = $result->fetch_assoc()) {
                    $idDan[] = $row["id_dania"];
                }
            } else {
                echo "Brak wyników";
            }

            // wyciaganie dań przez id
            $sql = "SELECT * FROM dania WHERE id IN (" . implode(", ", $idDan) . ");";
            $result = $conn->query($sql);
            echo '<div class="dania-container">';
            $rowNumber = $result->num_rows;

            if ($result->num_rows > 0) {

                $daniaValues = $result->fetch_all(MYSQLI_ASSOC);
            } else {
                echo "Brak wartości.";
            }

    
            for ($i = 0; $i < $rowNumber; $i++) {

                // wyciaganie sciezki zdjecia
                $sql = "SELECT zdjecie FROM dania_zdjecia WHERE id_dania=" . $daniaValues[$i]['id'] . ";";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $sciezkaZdjecia = $row["zdjecie"];
                    }
                } else {
                    echo "brak danych";
                }

                echo '<div class="danie-box">';
                echo '<img src="' . $sciezkaZdjecia . '" class="zdjecie-danie">';
                echo '<div class="danie-dane">';
                echo "<h1>" . $daniaValues[$i]['nazwa_dania'] . " </h1>";
                echo "<p>" . $daniaValues[$i]['opis'] . " </p>";
                if ($daniaValues[$i]['wegetarianskie']) {
                    echo "<p>Czy jest wegetariańskie?: Tak</p>";
                } else
                    echo "<p>Czy jest wegetariańskie?: Nie</p>";
                echo "<p>Kuchnia: " . $daniaValues[$i]['kuchnia'] . " </p>";
                
            // wyciąganie nazwy restauracji
            $sql = "SELECT id_restauracji FROM restauracje_dania WHERE id_dania = '" . $daniaValues[$i]['id'] . "';";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    $idRestauracji_dania = $row["id_restauracji"];
                }
            } else {
                echo "brak danych";
            }

            $sql = "SELECT nazwa_restauracji FROM restauracje WHERE id = '" . $idRestauracji_dania . "';";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    $nazwaRestauracji_dania = $row["nazwa_restauracji"];
                    echo "<p>Restauracja: $nazwaRestauracji_dania</p>";
                }
            } else {
                echo "brak danych";
            }
                //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
                $sql = "SELECT * FROM dania_skladniki WHERE id_dania = '" . $daniaValues[$i]['id'] . "';";

                $result = $conn->query($sql);


                if ($result->num_rows > 0) {
                    $sklad = [];
                    while ($row = $result->fetch_assoc()) {
                        $sklad[] = $row['id_skladnika'];
                    }
                } else {
                    echo "Brak tabel.";
                }
                echo "<p>Produkty: ";

                $sql = "SELECT nazwa_skladnika FROM skladniki WHERE id IN (" . implode(", ", $sklad) . ");";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $sklad_nazwy = [];
                    while ($row = $result->fetch_assoc()) {
                        $sklad_nazwy[] = $row['nazwa_skladnika'];
                    }

                    $skladiki = implode(", ", $sklad_nazwy);
                    echo "$skladiki</p>";
                    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                    echo "</div>";
                    echo "</div>";

                }
            }
            
        }

        // WYŚWIETLANIE DAŃ
        if (isset($_POST['restauracja-button'])) {
            $idRestauracji = $_POST['restauracja-button'];
            $_SESSION['idRestauracji'] = $idRestauracji;
        }

        if (isset($_SESSION['idRestauracji'])) {
            $idRestauracji = $_POST['restauracja-button'];

            echo '<div class="dania-container">';

            unset($_SESSION['idRestauracji']);


            $sql = "SELECT * FROM restauracje_dania WHERE id_restauracji = '" . $idRestauracji . "';";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $idDan = [];
                while ($row = $result->fetch_assoc()) {
                    $idDan[] = $row['id_dania'];
                }
            } else {
                echo "Brak tabel.";
            }

            $sql = "SELECT * FROM dania WHERE id IN (" . implode(", ", $idDan) . ");";
            $result = $conn->query($sql);

            $rowNumber = $result->num_rows;

            if ($result->num_rows > 0) {

                $daniaValues = $result->fetch_all(MYSQLI_ASSOC);
            } else {
                echo "Brak wartości.";
            }

            //print_r($daniaValues);
            
            
            for ($i = 0; $i < $rowNumber; $i++) {
                
                // wyciaganie sciezki zdjecia
                $sql = "SELECT zdjecie FROM dania_zdjecia WHERE id_dania=" . $daniaValues[$i]['id'] . ";";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $sciezkaZdjecia = $row["zdjecie"];
                    }
                } else {
                    echo "brak danych";
                }
                
                echo '<div class="danie-box">';
                echo '<img src="' . $sciezkaZdjecia . '" class="zdjecie-danie">';
                echo '<div class="danie-dane">';
                echo "<h1>" . $daniaValues[$i]['nazwa_dania'] . " </h1>";
                echo "<p>" . $daniaValues[$i]['opis'] . " </p>";
                if ($daniaValues[$i]['wegetarianskie']) {
                    echo "<p>Czy jest wegetariańskie?: Tak</p>";
                } else
                    echo "<p>Czy jest wegetariańskie?: Nie</p>";
                echo "<p>Kuchnia: " . $daniaValues[$i]['kuchnia'] . " </p>";

            $sql = "SELECT nazwa_restauracji FROM restauracje WHERE id = '" . $idRestauracji . "';";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    $nazwaRestauracji_dania = $row["nazwa_restauracji"];
                    echo "<p>Restauracja: $nazwaRestauracji_dania</p>";
                }
            } else {
                echo "brak danych";
            }
                //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
                $sql = "SELECT * FROM dania_skladniki WHERE id_dania = '" . $daniaValues[$i]['id'] . "';";

                $result = $conn->query($sql);


                if ($result->num_rows > 0) {
                    $sklad = [];
                    while ($row = $result->fetch_assoc()) {
                        $sklad[] = $row['id_skladnika'];
                    }
                } else {
                    echo "Brak tabel.";
                }
                echo "<p>Produkty: ";

                $sql = "SELECT nazwa_skladnika FROM skladniki WHERE id IN (" . implode(", ", $sklad) . ");";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $sklad_nazwy = [];
                    while ($row = $result->fetch_assoc()) {
                        $sklad_nazwy[] = $row['nazwa_skladnika'];
                    }

                    $skladiki = implode(", ", $sklad_nazwy);
                    echo "$skladiki</p>";
                    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                    echo "</div>";
                    echo "</div>";

                }
            }
        }
        echo '</div>';
    }

    ?>
</body>

</html>