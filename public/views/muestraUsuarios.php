<?php
    session_start();
    include_once "../models/usuario.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
</head>
<body>
    <?php
        //si la session con usuarios no está vacia muestra los usuarios
        if(isset($_SESSION['usuarios']) && !empty($_SESSION['usuarios']))
        {
            $usuarios=$_SESSION['usuarios'];
            ?>
            <div class="contenedorUsuarios">
            <?php
            foreach($usuarios as $usuario)
            {
                echo "<div class='usuarios'>
                    <ul class='listaUsuarios'>
                        <li>".$usuario['correo']."</li>
                        <li>".$usuario['nick']."</li>
                        <li>".$usuario['karma']."</li>
                    </ul>
                </div>";
            }
            ?>
            </div>
            <?php
        }
        //si no se le indica al usuario que no se ha encontrado nada
        else{
            echo "<div><p>No hay usuarios con ese criterio</p></div>";
        }
        $_SESSION['usuarios']=null;
    ?>
</body>
</html>
