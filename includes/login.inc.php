<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $errors = [];

    $username = trim($_POST['username']);
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
        header("Location: ../login.php");
        die();
    }

    $pwd = trim($_POST['pwd']);
    $pwd = filter_var($pwd, FILTER_SANITIZE_STRING);
    if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $pwd)) {
        header("Location: ../login.php");
        die();
    }

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