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




if (isset($_POST['edit-relacyjna'])) {
                
    $wart1 = $_POST['id_1'];
    $wart2 = $_POST['id_2'];
    $nazwaKol1=$_POST['nazwa1'];
    $nazwaKol2=$_POST['nazwa2'];
    
    $sql = "DELETE FROM ". $_SESSION["tableName"] ." WHERE $nazwaKol1=$wart1 AND $nazwaKol2=$wart2;";
    //$conn->query($sql);
    echo $sql;

    
    
}



if (isset($_POST['edit'])) {
    
    $wart = $_POST['id'];
    $_SESSION["idRekordu"] = $wart;


    //$sql = "DELETE FROM ". $_SESSION["tableName"] ." WHERE id=$wart;";
    //$conn->query($sql);

    echo"<table  class='tabela-wyniki'>";


    foreach($_SESSION['ColumnNames'] as $kolumna)
    {
        echo"<th>$kolumna</th>";
    }


    

    $sql = "SELECT " . implode(", ", $_SESSION['ColumnNames']) . " FROM " . $_SESSION["tableName"] . " WHERE id = $wart;";
    $result = $conn->query($sql);
    //$dane = $result->fetch_all(MYSQLI_ASSOC);

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

    //$collumnNumber = $_SESSION['colNum'];
    //for ($i = 1; $i < $collumnNumber; $i++) {
    //    if ($i == 1) {
    //        echo '<td>' . ($result->num_rows + 1) . '</td>';
    //    }
    //    echo "<td><input type='text' value='" . $dane[$i] . "' name='wartosci[]'></td>";
    //}


    foreach ($dane as $dana) {
        echo "<td><input type='text' value='" . $dana . "' name='wartosci[]'></td>";
    }
    echo '</tr>';
    echo"</table>";
    echo '<button type="submit" name="update">update</button>';
    echo '</form>';
    
    

    
}
if (isset($_POST['update'])) {

    $id = $_SESSION["idRekordu"];

    $wartosci = $_POST['wartosci'];
    $collumnNumber = $_SESSION['colNum'];
    $gigaString = "";
    for ($i = 1; $i <= $collumnNumber-1; $i++) {
        $gigaString .= $_SESSION['ColumnNames'][$i] . " = '" . $wartosci[$i] . "', ";
    }
    $gigaString = rtrim($gigaString, ", ");
    //echo $gigaString;
    $sql = "UPDATE " . $_SESSION["tableName"] . " SET " . $gigaString . " WHERE id = " . $id . ";";
    $conn->query($sql);
    echo $sql;
}

?>
</div>
</body>
</html>