<?php
    include_once "../controllers/error.php";
    //si el usuario no esta loggeado redirige al formulario de login
    comprobar_perfil($usuario);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar contraseña</title>
</head>
<body>
    <!-- form para cambiar contraseña -->
    <form action="../controllers/password.php" method="post" name="formPassword">

        <?php
            //si el campo está vacio muestra el error
            echo "$passwordEmpty $passwordIncorrect";?>

        <label for="password1">Introduce tu contraseña</label>
        <input type="password" name="password1" placeholder="********" required>

        <?php
            //lo mismo para las contraseñas de abajo y si tienen el formato correcto
            echo "$password2Empty $passwordFormat"; ?>

        <label for="password2">Introduce tu nueva contraseña</label>
        <input type="password" name="password2" placeholder="********" required>

        <?php
            //si las contraseñas no coinciden muestra el error
            echo $passwordNotRepeated;?>
        
        <label for="password3">Introduce tu nueva de nuevo</label>
        <input type="password" name="password3" placeholder="********" required>
        <input type="submit" value="cambiar contraseña">
    </form>
</body>
</html>
