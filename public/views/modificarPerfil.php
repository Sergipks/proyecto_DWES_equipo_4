<?php
    //incluimos las variables de error
    include_once "../controllers/error.php";
    //si la sesion no contiene nada significa que el usuario no está loggeado, redirigiendo al login
     //si el usuario no esta loggeado no mostrará el formulario y redirigirá al login
     comprobar_perfil($usuario);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar perfil</title>
</head>
<body>

    <?php 
        //si algo ha fallado en la modificacion salta este error
        echo $errorUpdate;
    ?>

    <!-- formulario para la modificacion del usuario loggeado -->
    <form action="../controllers/modificar.php" method="post" class="formMod">
        
        <?php
            //si el nombre está vacio mostrará se mostrará el error
            echo $nombreEmpty; 
        ?>

        <label for="nombre">Cambia tu nombre</label>
        <input type="text" name="nombre" value="<?php echo $usuario->getNombre()?>" placeholder="nombre..." required>

        <?php
            //lo mismo para el apellido
            echo $apellidoEmpty; 
         ?>

        <label for="apellidos">Cambia tus apellidos</label>
        <input type="text" name="apellidos" value="<?php echo $usuario->getApellidos()?>"placeholder="apellidos..." required>

        <input type="submit" value="Cambiar"> 
    </form>
</body>
</html>
