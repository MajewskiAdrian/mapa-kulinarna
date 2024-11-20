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

if (!isset($_SESSION['wizyta_sesji'])) {
    $_SESSION['wizyta_sesji'] = 1;
    echo "Liczba odwiedzin: " . $_COOKIE['liczba_odwiedzin'] + 1 . "<br>";
} else {
    echo "Liczba odwiedzin: " . $_COOKIE['liczba_odwiedzin'] . "<br>";
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

        fetch("countries-medium.json")
            .then(response => response.json())
            .then(data => {
                // Dodanie warstwy GeoJSON do mapy
                L.geoJSON(data, {
                    style: {
                        color: "#ff7800",
                        weight: 2,
                        opacity: 0.65
                    },
                    onEachFeature: function (feature, layer) {
                        layer.on('click', function (e) {
                            // Przesyłanie nazwy państwa do PHP
                            var countryName = feature.properties.name;
                            sendCountryToPHP(countryName);
                        });
                    }
                }).addTo(map);
            })
            .catch(error => console.error('Błąd ładowania GeoJSON:', error));


            function sendCountryToPHP(country) {

                var xhttp = new XMLHttpRequest();
                xhttp.open("POST", "test.php", true); // PHP skrypt
                xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhttp.send("country=" + encodeURIComponent(country));
             }
    </script>
    <?php
    //echo test();
    //test();

        // Pobranie nazwy państwa z przesłanego formularza
        if (isset($_SESSION["country"])) {

            echo "Otrzymana nazwa państwa: " . $_SESSION["country"];
            unset($_SESSION["country"]);
            // Możesz tutaj wykonać inne operacje, np. zapis do bazy danych
        }

    ?>

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
                echo '<form action="" method="POST">';
                echo '<button type="submit" class="button-restauracja" name="restauracja-button" value="' . $idRestauracji . '">';
                echo '<div class="restuaracja-box">';
                echo "<p class='restauracja-nazwa'>" . $row["nazwa_restauracji"] . "</p>";
                echo '<span class="restauracja-dane">';
                echo "Państwo: " . $row["panstwo"] . "<br>";
                echo "Adres: " . $row["ulica"] . ', ' . $row["miasto"] . "";
                echo '</span>';
                echo '</div>';

                //echo "<input type='submit' name='restauracja-button' value='$idRestauracji'>";
                echo '</button>';
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

        /*if ($result->num_rows > 0) {
            
            $nazwyDan = [];
            $opisyDan = [];
            $wegetarianskie = [];
            $kuchnia = [];


            $tableValues = $result->fetch_all(MYSQLI_ASSOC);

            while ($row = $result->fetch_assoc()) {
                $nazwyDan[] = $row['nazwa_dania'];
                $opisyDan[] = $row['opis'];
                $wegetarianskie[] = $row['wegetarianskie'];
                $kuchnia[] = $row['kuchnia'];
            }
        } else {
            echo "Brak tabel.";
        }*/


        if ($result->num_rows > 0) {

            $daniaValues = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            echo "Brak wartości.";
        }

        //print_r($daniaValues);
    


        for ($i = 0; $i < $rowNumber; $i++) {
            echo '<div class="danie-box">';
            echo '<img src="images/ciasto-z-jajem.jpg" class="zdjecie-danie">';
            echo '<div class="danie-dane">';
            echo "<h1>" . $daniaValues[$i]['nazwa_dania'] . " </h1>";
            echo "<p>" . $daniaValues[$i]['opis'] . " </p>";
            if ($daniaValues[$i]['wegetarianskie']) {
                echo "<p>Czy jest wegetariańskie?: Tak</p>";
            } else
                echo "<p>Czy jest wegetariańskie?: Nie</p>";
            echo "<p>Kuchnia: " . $daniaValues[$i]['kuchnia'] . " </p>";

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






            /*print_r($daniaValues);
            foreach ($daniaValues as $danieValue) {
                echo "<div class='danie-box'>";
                foreach ($danieValue as $dana) {
                    echo $dana;
                    echo "<br>";
                } 
                    
                
               
                echo "</div>";
            }*/


        }



        /*if ($result->num_rows > 0) {

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
        }*/

    }

    echo '</div>';

    ?>
</body>

</html>