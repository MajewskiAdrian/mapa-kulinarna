<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['country'])) {
    unset($_SESSION["country"]);
    $countryName = $_POST['country'];
    $_SESSION["country"] = $countryName;
    

    echo "Otrzymano nazwę państwa: " . htmlspecialchars($countryName);
    
} else {
    echo "Nie otrzymano danych.";
}


