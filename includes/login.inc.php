<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    try {
        require_once 'db_conn.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        $errors = [];

        if (isInputEmpty($username, $pwd)) {
            $errors["empty_input"] = "Wypełnij wszystkie pola";
        }

        $result = getUser($pdo, $username);

        if (isUsernameWrong($result)) {
            $errors["login_incorrect"] = "Niepoprawne dane logowania";
        }
        if (!isUsernameWrong($result) && isPasswordWrong($pwd, $result['pwd'])) {
            $errors["login_incorrect"] = "Niepoprawne hasło";
        }


        if ($errors) {
            $_SESSION["errors_login"] = $errors;

            header("Location: ../login.php");
            die();
        }

        $_SESSION['user'] = 'admin';
        header("location: ../login.php?login=success");
        
        $stmt = null;
        $pdo = null;

        die();

    } catch (PDOException $e) {
        die("query failed " . $e->getMessage());
    }
} else {
    header("Location: ../login.php");
    die();
}