<?php
session_start();
require_once "includes/login_view.inc.php";
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/login.css">
    <title>Logowanie</title>
</head>

<body class="body-form">
    <section class="wrapper-form">
        <h4>Zaloguj</h4>
        <form class="form" action="includes/login.inc.php" method="post">
            <input type="text" name="username" placeholder="Nazwa użytkownika" ><br>
            <input type="password" name="pwd" placeholder="Hasło"><br>
            <button type="submit">Zaloguj</button>
        </form>

        <?php
        checkLoginErrors();
        ?>
        
    </section>
</body>

</html>