<?php
session_start();
require_once '../includes/db_conn.php';
if (!isset($_SESSION['user'])) {
    header("location: ../login.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/main.css">
    <title>Panel</title>
</head>

<body>

    <div class="panel-wrapper">
        <div class="sidebar-panel">

            <h1> Tabele </h1>
            <?php
            $sql = "SHOW FULL TABLES WHERE Table_type = 'BASE TABLE';";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $tableNames = [];
                while ($row = $result->fetch_assoc()) {
                    $tableNames[] = $row['Tables_in_mapa_kulinarna'];
                }
            } else {
                echo "Brak tabel.";
            }
            echo '<form action="" method="post">';
            foreach ($tableNames as $tableName) {
                echo "<button class='button-tabele' type='submit' name='tableName' value='$tableName'>";
                echo "$tableName";
                echo '</button>';
            }
            echo "</form>";

            ?>

            <h1> Widoki </h1>

            <?php
            $sql = "SHOW FULL TABLES WHERE Table_type = 'VIEW';";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $viewNames = [];
                while ($row = $result->fetch_assoc()) {
                    $viewNames[] = $row['Tables_in_mapa_kulinarna'];
                }
            } else {
                echo "Brak tabel.";
            }

            echo '<form action="" method="post">';
            foreach ($viewNames as $viewName) {
                echo "<button type='submit' class='button-tabele' name='viewName' value='$viewName'>";
                echo "$viewName";
                echo '</button>';
            }
            echo "</form>";

            // Wylogowywanie
            echo '<h1> Wylogowywanie </h1>';
            echo '<form action="../includes/logout.inc.php" method="post">';
            
            echo "<button type='submit' class='button-tabele'> Wyloguj </button>";
            
            echo "</form>";


            ?>
        </div>
        <section class="wyniki-container">

            <?php
            // WYŚWIETLANIE TABEL
            if (isset($_POST['tableName'])) {

                $columnNumber = 0;

                $tableName = $_POST['tableName'];
                $_SESSION["tableName"] = $tableName;
                echo '<div class="panel-header">';
                echo "Wybrano tabelę: $tableName";
                echo '</div>';

                $sql = "SELECT * FROM $tableName;";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    $tableValues = $result->fetch_all(MYSQLI_ASSOC);
                } else {
                    echo "Brak wartości.";
                }

                // Tworzenie tabeli 
                echo '<table class="tabela-wyniki">';
                echo '<tr>';

                $nazwyKolumn = [];

                foreach (array_keys($tableValues[0]) as $nazwaKolumny) {
                    echo "<th>" . $nazwaKolumny . "</th>";

                    $nazwyKolumn[] = $nazwaKolumny;

                    $columnNumber++;
                }
                $_SESSION["columnNames"] = $nazwyKolumn;
                echo "<th> Edytuj </th>";
                echo "<th> Usuń </th>";
                echo "</tr>";

                foreach ($tableValues as $wiersz) {
                    echo "<tr>";
                    foreach ($wiersz as $komorka) {

                        echo "<td>" . $komorka . "</td>";
                        $wartoscKomorki[] = $komorka;
                    }

                    // Przyciski edycji dla tabel 
                    if ($tableName == 'restauracje_dania' || $tableName == 'dania_skladniki') {
                        echo '<form action="edit.php" method="post">';
                        echo '<input type="hidden" value="' . $wartoscKomorki[0] . '" name="id_1">';
                        echo '<input type="hidden" value="' . $wartoscKomorki[1] . '" name="id_2">';
                        echo "<td class='cell-center-edt'> <button type='submit' class='button-edit' name='edit-laczaca'> <img src='../icons/pen-to-square-regular.svg' class='button-icon' /> </button> </td>";
                        echo '</form>';

                    } else {
                        echo '<form action="edit.php" method="post">';
                        echo '<input type="hidden" value="' . $wartoscKomorki[0] . '" name="id">';
                        echo "<td class='cell-center-edt'> <button type='submit' class='button-edit' name='edit'> <img src='../icons/pen-to-square-regular.svg' class='button-icon' /> </button> </td>";
                        echo '</form>';

                    }


                    // Przyciski usuwania dla tabel 
                    if ($tableName == 'restauracje_dania' || $tableName == 'dania_skladniki') {
                        echo '<form action="" method="post">';
                        echo '<input type="hidden" value="' . $wartoscKomorki[0] . '" name="id_1">';
                        echo '<input type="hidden" value="' . $wartoscKomorki[1] . '" name="id_2">';
                        echo '<input type="hidden" value="' . $nazwyKolumn[0] . '" name="nazwa1">';
                        echo '<input type="hidden" value="' . $nazwyKolumn[1] . '" name="nazwa2">';
                        echo "<td class='cell-center-del'> <button type='submit' class='button-delete' name='delete-laczaca'> <img src='../icons/trash-outline.svg' class='button-icon' /> </button> </td>";
                        echo '</form>';
                        echo "</tr>";
                    } else {
                        echo '<form action="" method="post">';
                        echo '<input type="hidden" value="' . $wartoscKomorki[0] . '" name="id">';
                        echo "<td class='cell-center-del'> <button type='submit' class='button-delete' name='delete'> <img src='../icons/trash-outline.svg' class='button-icon' /> </button> </td>";
                        echo '</form>';
                        echo "</tr>";
                    }
                    unset($wartoscKomorki);
                }

                // Wiersz do wprowadzania nowych rekordów
                echo '<tr>';

                if ($tableName == 'restauracje_dania' || $tableName == 'dania_skladniki') {
                    echo '<form action="" method="post">';
                    $_SESSION['colNum'] = $columnNumber;
                    for ($i = 0; $i < $columnNumber; $i++) {
                        echo '<td><input class="add-input" type="number" name="wartosc[]" required></td>';
                    }
                    echo "<td colspan='2'  id='add-scroll' class='cell-center-add'><button type='submit' name='add-laczaca' class='button-add'><img src='../icons/plus-solid.svg' class='button-icon' /></button></td>";

                } else {
                    echo '<form action="" method="post">';
                    $_SESSION['colNum'] = $columnNumber;
                    $_SESSION["columnNames"] = $nazwyKolumn;
                   
                    for ($i = 1; $i < $columnNumber; $i++) {
                        if ($i == 1) {
                            echo '<td> </td>';
                        }
                        echo '<td><input  class="add-input" type="text" name="wartosc[]" required></td>';
                    }
                    echo "<td colspan='2' id='add-scroll' class='cell-center-add'><button type='submit' class='button-add' name='add'><img src='../icons/plus-solid.svg' class='button-icon' /></button></td>";
                }

                echo '</form>';
                echo '</tr>';
                echo '</table>';
            }


            // WYŚWIELANIE WIDOKÓW
            if (isset($_POST['viewName'])) {
                $viewName = $_POST['viewName'];
                echo '<div class="panel-header">';
                echo "Wybrano widok: $viewName";
                echo '</div>';

                $sql = "SELECT * FROM $viewName;";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    $viewValues = $result->fetch_all(MYSQLI_ASSOC);
                } else {
                    echo "Brak wartości.";
                }

                echo '<table class="tabela-wyniki">';
                echo '<tr>';

                foreach (array_keys($viewValues[0]) as $nazwaKolumny) {
                    echo "<th>" . $nazwaKolumny . "</th>";
                }

                echo "</tr>";

                foreach ($viewValues as $wiersz) {
                    echo "<tr>";
                    foreach ($wiersz as $komorka) {
                        echo "<td>" . $komorka . "</td>";
                    }

                    echo "</tr>";
                }
                echo '</table>';
            }

            // DODAWANIE REKORDÓW DO BAZY DANYCH 
            if (isset($_POST['add-laczaca'])) {

                $wartosci = $_POST['wartosc'];
                $tableName = $_SESSION["tableName"];

                try {
                    $sql = "INSERT INTO " . $_SESSION["tableName"] . " VALUES ('" . implode("', '", $wartosci) . "');";
                    $conn->query($sql);
                    echo '<div class="success-container">';
                    echo "Zapytanie: " . $sql . " <br> zostało wykonane pomyślnie. <br>";
                    echo "Dodano nowy rekord";
                    echo '</div>';
                }    
                catch (mysqli_sql_exception $e) {
                    echo '<div class="error-container">';
                    echo "Błąd podczas wykonywania zapytania:<br> " . $e->getMessage();
                    echo '</div>';
                }
            }

            if (isset($_POST['add'])) {

                $wartosci = $_POST['wartosc'];
                $tableName = $_SESSION["tableName"];

                try {
                    $sql = "INSERT INTO " . $_SESSION["tableName"] . " VALUES (NULL, '" . implode("', '", $wartosci) . "');";
                    $result = $conn->query($sql);
                    echo '<div class="success-container">';
                    echo "Zapytanie: " . $sql . " <br> zostało wykonane pomyślnie. <br>";
                    echo "Dodano nowy rekord ";
                    echo '</div>';
                }
                catch (mysqli_sql_exception $e) {
                    echo '<div class="error-container">';
                    echo "Błąd podczas wykonywania zapytania:<br>" . $e->getMessage();
                    echo '</div>';
                }

            }


            // USUWANIE REKORDÓW Z BAZY DANYCH 
            if (isset($_POST['delete-laczaca'])) {

                $wart1 = $_POST['id_1'];
                $wart2 = $_POST['id_2'];
                $nazwaKol1 = $_POST['nazwa1'];
                $nazwaKol2 = $_POST['nazwa2'];

                try {
                    $sql = "DELETE FROM " . $_SESSION["tableName"] . " WHERE $nazwaKol1=$wart1 AND $nazwaKol2=$wart2;";
                    $conn->query($sql);
                    echo '<div class="success-container">';
                    echo "Zapytanie: " . $sql . " <br> zostało wykonane pomyślnie. <br>";
                    echo "Rekord został usunięty";
                    echo '</div>';
                }
                catch (mysqli_sql_exception $e) {
                    echo '<div class="error-container">';
                    echo "Błąd podczas wykonywania zapytania:<br> " . $e->getMessage();
                    echo '</div>';
                }

            }

            if (isset($_POST['delete'])) {

                $wart = $_POST['id'];
                
                try {
                    $sql = "DELETE FROM " . $_SESSION["tableName"] . " WHERE id=$wart;";
                    $conn->query($sql);
                    echo '<div class="success-container">';
                    echo "Zapytanie: " . $sql . " <br> zostało wykonane pomyślnie. <br>";
                    echo "Rekord został usunięty";
                    echo '</div>';
                }    
                catch (mysqli_sql_exception $e) {
                    echo '<div class="error-container">';
                    echo "Błąd podczas wykonywania zapytania:<br> " . $e->getMessage();
                    echo '</div>';
                }
            }

            ?>
        </section>
    </div>
</body>
</html>