<?php
    include_once "../controllers/error.php";
     //si el usuario ya esta loggeado no mostrará el formulario y redirigirá al index
    comprobar_perfil_nulo($usuario);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta usuario</title>
</head>
<body>
    <!-- formulario para el alta de usuario -->
    <h2>Alta usuario</h2>
    <form action="../controllers/alta.php" method="post" name="formAlta">

        <?php
            //si el email está vacio ($email) o tiene un formato erróneo ($emailF) se mostrará o si ya está repetido ($emailR)
            echo "$emailEmpty $emailFormat $emailRepeated";
        ?>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <?php
            //lo mismo para el nombre, solo si está vacio
            echo "<p class='error'>$nombreEmpty</p>";
        ?>

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>

        <?php
            //lo mismo para el apellido
            echo "$apellidoEmpty";
        ?>

        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" required>
	
	<?php
            //lo mismo para el apellido
            echo "$passwordEmpty $passwordFormat";
        ?>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>
        
        <?php
            //lo mismo para el apellido
            echo "$password2Empty $passwordNotRepeated";
        ?>

        <label for="password2">Escribe de nuevo tu contraseña:</label>
        <input type="password" name="password2" required>
        
        <?php
            //lo mismo para el nickname ($nickname) o si ya está repetido ($nicknameR)
            echo "$nicknameEmpty $nicknameRepeated";
        ?>
        <label for="nickname">Nickname:</label>
        <input type="text" name="nickname" required>

        <input type="submit" value="Alta">
    </form>
</body>
</html>
