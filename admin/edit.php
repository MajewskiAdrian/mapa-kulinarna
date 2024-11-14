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

        // WYŚWIETLENIE EDYTOWANEGO REKORDU
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
                    echo "<td><input type='text' value='" . $dane[$i] . "' name='wartosciRekordu[]' required></td>";
                }
                
            }

            echo '</tr>';
            echo "</table>";
            echo '<button type="submit" name="update"> update </button>';
            echo '</form>';
        }

        // FUNKCJA EDYTUJĄCA REKORD
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

        // WYŚWIETLENIE EDYTOWANEGO REKORDU - jeżeli tabela łącząca
        if (isset($_POST['edit-laczaca'])) {

            $columnValue1 = $_POST['id_1'];
            $columnValue2 = $_POST['id_2'];

            echo "<table class='tabela-wyniki'>";

            $columnNumber = $_SESSION['colNum'];

            foreach ($_SESSION['columnNames'] as $kolumna) {
                echo "<th>$kolumna</th>";
            }
            $sqlWhere = "";
            $sqlWhere .= $_SESSION['columnNames'][0] . " = '" . $columnValue1 . "' AND " . $_SESSION['columnNames'][1] . " = '" . $columnValue2 . "'";

            echo '<form action="" method="POST">';
            echo '<tr>';
            
            echo "<td><input type='number' value='" . $columnValue1 . "' name='wartosciRekordu[]' required></td>";
            echo "<td><input type='number' value='" . $columnValue2 . "' name='wartosciRekordu[]' required></td>";
            

            echo '</tr>';
            echo "</table>";
            echo '<input type="hidden" value="' . $sqlWhere . '" name="sqlWhere">';
            echo '<button type="submit" name="update-laczaca"> update </button>';
            echo '</form>';        
        }

        // FUNKCJA EDYTUJĄCA REKORD - jeżeli tabela łącząca
        if (isset($_POST['update-laczaca'])) {

            $sqlWhere = $_POST['sqlWhere'];

            $wartosciRekordu = $_POST['wartosciRekordu'];
            $columnNumber = $_SESSION['colNum'];
            $sqlSet = "";
            for ($i = 0; $i < $columnNumber; $i++) {
                $sqlSet .= $_SESSION['columnNames'][$i] . " = '" . $wartosciRekordu[$i] . "', ";
            }
        
            $sqlSet = rtrim($sqlSet, ", ");

            $sql = "UPDATE " . $_SESSION["tableName"] . " SET " . $sqlSet . " WHERE " . $sqlWhere . ";";
            $conn->query($sql);
            echo $sql;
        }

        ?>
    </div>
</body>

</html>