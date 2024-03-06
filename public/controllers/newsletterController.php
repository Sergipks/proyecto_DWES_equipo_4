<?php
require_once("DB/iniciarPDO.php");

if (isset($_POST["email"]) && filter_var($_POST["email"], FILTER_SANITIZE_EMAIL) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    try {
        $pdo = iniciarPDO();
        $resultado = $pdo->query("SELECT * FROM usuarios u WHERE u.suscritoNewsletter = TRUE");
        
        foreach ($resultado as $row) {
            echo "a";
            if ($row["correo"] == $_POST["email"]){
                //Ya esta suscrito, se le indica un error
                header("location: index.php?suscrito=false&error=yaSuscrito");
                die;
            }
        }
        $pdo->exec("UPDATE usuarios SET suscritoNewsletter=TRUE WHERE correo = '{$_POST["email"]}';");
        header("location: index.php?suscrito=true");
        die;
    } catch(Exception $e) {
        echo $e;
        header("location: index.php?suscrito=false&error=errorBaseDatos");
        die;
    }
}

header("location: index.php?suscrito=false&error=correoNoValido");
die;
?>