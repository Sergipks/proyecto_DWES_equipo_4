<?php
    //incluir archivos de errores
    include_once "../controllers/error.php";
    //si el usuario ya está loggeado redirigirá al index
    comprobar_perfil_nulo($usuario);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio sesión</title>
</head>
<body>
    <?php
        //error por si el usuario accede a alguna página web sin iniciar sesion
        echo "$notLogged";
    ?>
    <!--formulario para el login, donde se pedirá el email y password -->
    <h2>Login usuario</h2>
    <form action="../controllers/login.php" name="formLogin" method="post">

        <?php
            //si el email está vacio, $emailL contendrá ese aviso
            echo "$emailEmpty";
        ?>

        <label for="email">Inserte el email</label>
        <input type="email" name="email" placeholder="Email..." required>

        <?php
            //lo mismo para el password
            echo "$passwordEmpty";
        ?>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" placeholder="******" required>

        <?php
            //si el usuario o contraseña son erroneos contendrá ese aviso
            echo "$errorLog";
        ?>

        <input type="submit" value="Iniciar sesión">
    </form>
</body>
</html>
