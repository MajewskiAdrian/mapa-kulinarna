<?php
$host = 'localhost'; 
$dbusername = 'root'; 
$dbpassword = ''; 
$dbname = 'mapa_kulinarna'; 
$dsn = "mysql:host=localhost; dbname=mapa_kulinarna";

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);


if ($conn->connect_error) {
    die("Połączenie nieudane: " . $conn->connect_error);
}

try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}