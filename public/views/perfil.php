<?php
    //se empieza la sesión y si no esta loggeado se redirige a la pagina de login con error
    include_once "../controllers/error.php";
    include_once "../controllers/comprobarDatos.php";
    comprobar_perfil($usuario);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $usuario->getNickname();?></title>
</head>
<body>
    
    <?php
        //si el cambio de contraseña falla se muestra 
        echo $errorPassword;
        //si el cambio de contraseña es correcto se muestra
        echo $passwordChanged;
    ?>

    <!-- campo para mostrar los atributos del usuario -->
    <div id="perfil">
        <h2><?php echo $usuario->getNickname(); ?></h2>
        <p>Nombre: <?php echo $usuario->getNombre(); ?></p>
        <p>Apellidos: <?php echo $usuario->getApellidos(); ?></p>
        <p>Email: <?php echo $usuario->getEmail(); ?></p>
        <p>Karma: <?php echo $usuario->getKarma(); ?></p>
        <p><a href="modificarPerfil.php" class="btn btn-primary">Modificar perfil</a>
            <a href="passwordUsuario.php" class="btn btn-primary">Cambiar contraseña</a>
            <a href="../controllers/logout.php">Log out</a></p>
        <div class="eventos">
            <h2>Eventos participados </h2>
            <ul>
                <li>Id evento</li>
                <li>Nombre evento</li>
                <li>Fecha evento</li>
                <li>Número participantes evento</li>
                <li>Asistió como:</li>
                <li>Tipo evento</li>
            </ul>   

            <?php
                //aquí cargaremos los eventos en los que el usuario es anfitrion
                $eventos=$usuario->getEventos();
                foreach($eventos as $evento)
                {
                    echo "<div class='evento'>
                        <ul class='eventos'>
                            <li>".$evento->getId()."</li>
                            <li>".$evento->getNombre()."</li>
                            <li>".$evento->getFecha()."</li>
                            <li>".$evento->getParticipantes()."</li>
                            <li>".$evento->getUbicacion()."</li>
                            <li>";
                            if($evento->getAnfitrion()==$usuario->getNickname() ){
                                    echo "Anfitrion";
                            }
                            else{
                                echo "Asistente";
                            }
                            echo "</li>
                            <li>".$evento->getTipoEvento()."</li>
                        </ul>
                    </div>";
                }
            ?>

        </div>
    </div>
</body>
</html>
