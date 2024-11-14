<?php
session_start();
require_once '../includes/db_conn.php';
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
                echo "<button type='submit' name='tableName' value='$tableName'>";
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
                echo "<button type='submit' name='viewName' value='$viewName'>";
                echo "$viewName";
                echo '</button>';
            }
            echo "</form>";


            ?>
        </div>
        <section class="wyniki-container">

            <?php
            if (isset($_POST['tableName'])) {

                $collumnNumber = 0;
                
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

                echo '<table class="tabela-wyniki">';
                echo '<tr>';

                foreach (array_keys($tableValues[0]) as $nazwaKolumny) {
                    echo "<th>" . $nazwaKolumny . "</th>";
                    $collumnNumber++;
                }

                echo "<th> Edytuj </th>";
                echo "<th> Usuń </th>";
                echo "</tr>";

                foreach ($tableValues as $wiersz) {
                    echo "<tr>";
                    foreach ($wiersz as $komorka) {
                        echo "<td>" . $komorka . "</td>";
                    }
                    echo "<td> <button type='submit'> edit </button> </td>";
                    echo "<td> <button type='submit'> delete </button> </td>";
                    echo "</tr>";
                }

                echo '<tr>';

                echo '<form action="" method="post">';

                for ($i = 1; $i < $collumnNumber; $i++) {
                    if ($i == 1) {
                        echo '<td>' . ($result->num_rows + 1) . '</td>';
                    }
                    echo '<td><input type="text" name="wartosc[]"></td>';
                }
                echo "<td colspan='2'><button type='submit' name='add'>add</button></td>";

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


            if (isset($_POST['add'])) {
                
                $wartosci = $_POST['wartosc'];
    
                $sql = "INSERT INTO " . $_SESSION["tableName"] . " VALUES (NULL, '" . implode("', '", $wartosci) . "');";
                $conn->query($sql);
                echo $sql;

            }
            ?>
        </section>
    </div>
</body>

</html>