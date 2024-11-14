<?php
session_start();
require_once '../includes/db_conn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/main.css">
    <title>Edytuj</title>
</head>

<body>
    <div class="edytowanie">
        <?php




        if (isset($_POST['edit-laczaca'])) {

            $wart1 = $_POST['id_1'];
            $wart2 = $_POST['id_2'];
            $nazwaKol1 = $_POST['nazwa1'];
            $nazwaKol2 = $_POST['nazwa2'];

            //$sql = "DELETE FROM " . $_SESSION["tableName"] . " WHERE $nazwaKol1=$wart1 AND $nazwaKol2=$wart2;";
            //$conn->query($sql);
            echo $sql;

            // Reszta funkcjonalności (jeszcze nie ma)
        
        }



        if (isset($_POST['edit'])) {

            $id = $_POST['id'];
            $_SESSION["idRekordu"] = $id;
        
            echo "<table class='tabela-wyniki'>";

            foreach ($_SESSION['columnNames'] as $kolumna) {
                echo "<th>$kolumna</th>";
            }

            $sql = "SELECT " . implode(", ", $_SESSION['columnNames']) . " FROM " . $_SESSION["tableName"] . " WHERE id = $id;";
            $result = $conn->query($sql);
        
            if ($result->num_rows > 0) {
                $dane = [];
                while ($row = $result->fetch_row()) {
                    $dane = $row;
                }
            } else {
                echo "Brak danych.";
            }

            echo '<form action="" method="POST">';
            echo '<tr>';

            $columnNumber = $_SESSION['colNum'];
            
            for ($i = 0; $i < $columnNumber; $i++) {
                if ($i == 0) {
                    echo '<td>' . $id . '</td>';
                } else {
                    echo "<td><input type='text' value='" . $dane[$i] . "' name='wartosciRekordu[]'></td>";
                }
                
            }

            echo '</tr>';
            echo "</table>";
            echo '<button type="submit" name="update"> update </button>';
            echo '</form>';
        }

        if (isset($_POST['update'])) {

            $id = $_SESSION["idRekordu"];

            $wartosciRekordu = $_POST['wartosciRekordu'];
            $columnNumber = $_SESSION['colNum'];
            $sqlSet = "";
            for ($i = 0; $i < $columnNumber - 1; $i++) {
                $sqlSet .= $_SESSION['columnNames'][$i+1] . " = '" . $wartosciRekordu[$i] . "', ";
            }
        
            $sqlSet = rtrim($sqlSet, ", ");
  
            $sql = "UPDATE " . $_SESSION["tableName"] . " SET " . $sqlSet . " WHERE id = " . $id . ";";
            $conn->query($sql);
            echo $sql;
        }

        ?>
    </div>
</body>

</html>