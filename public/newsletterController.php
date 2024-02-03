<?php
require_once("iniciarPDO.php");

if (isset($_POST["email"]) && filter_var($_POST["email"], FILTER_SANITIZE_EMAIL) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $pdo = iniciarPDO();
    $pdo->query("SELECT * FROM usuarios u WHERE u.suscritoNewsletter = FALSE");

    foreach ($conn->query($sql) as $row) {
        if ($row["correo"] == $_POST["email"]){
            //Ya esta suscrito, se le indica un error
            header("location: index.html?error=yaSuscrito");
            die;
        }
    }

    $pdo->exec("UPDATE usuarios u SET u.suscritoNewsletter=TRUE WHERE u.correo = {$_POST["email"]}");
}

header("location: index.html");
die;
?>