<?php

function checkLoginErrors() 
{
    if (isset($_SESSION["errors_login"])){
        $errors = $_SESSION["errors_login"];

        echo '<br>';

        foreach ($errors as $error) {
            echo '<div class="form-error">';
            echo '<p>' . $error . '</p>';
            echo '</div>';
        }

        unset($_SESSION["errors_login"]);
    } else if (isset($_GET['login']) && $_GET['login'] === "success") {
        echo '<br>';
        echo '<div class="form-success">Zalogowano</div>';
        header("location: admin/");
    }
    
}