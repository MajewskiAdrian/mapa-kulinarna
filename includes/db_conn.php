<?php
$host = 'localhost'; 
$dbusername = 'root'; 
$dbpassword = ''; 
$dbname = 'mapa_kulinarna'; 

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);


if ($conn->connect_error) {
    die("Połączenie nieudane: " . $conn->connect_error);
}

