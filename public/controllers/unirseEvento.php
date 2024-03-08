<?php
    //iniciamos la sesion y comprobamos que el usuario esté loggeado, si no redirige al login
    session_start();
    include_once "database.php";
    include_once "comprobarDatos.php";
    include_once "../models/usuario.php";
    comprobar_perfil($_SESSION['perfil']);
    $usuario=unserialize($_SESSION['perfil']);
    //si el id del evento está vacío redirige a la página de eventos con el error
    if(!isset($_REQUEST['id']))
    {
        header("location: ../views/eventos.php?idEventoEmpty=true");
        die();
    }
    $idEvento=$_REQUEST['id'];
    //conectamos con la bbdd
    $conn=new PDO("mysql:host=$server;dbname=$db",$user,$pwd);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //seleccionamos al evento con el id recibido, si no lo encuentra salta error y redirige a la pagina de eventos
    $query="SELECT id,nombre,fecha,ubicacion,anfitrion,tipo_evento FROM eventos WHERE id= :id";
    $stmtEvento=$conn->prepare($query);
    $stmtEvento->bindParam(':id',$idEvento);
    $stmtEvento->execute();
    $evento=$stmtEvento->fetchAll(PDO::FETCH_ASSOC);
    if(!empty($evento))
    {
        //Seleccionamos todos los participantes de ese evento, si no encuentra nada el resultado será 0
        $query="SELECT COUNT(*) FROM asistentes WHERE evento= :id";
        $stmtAsistentes=$conn->prepare($query);
        $stmtAsistentes->bindParam(":id",$idEvento);
        $stmtEvento->execute();
        $participantes=$stmtAsistentes->fetch(PDO::FETCH_ASSOC);
        //añadimos el evento al array de eventos del usuario
        $usuario->addEvento(new Evento($evento['id'],$evento['nombre'],$evento['fecha'],$evento['ubicacion'],$evento['anfitrion'],$evento['tipo_evento'],$participantes['COUNT(*)']));
        
        //modificamos el perfil del usuario con el nuevo usuario con el evento añadido
        $_SESSION['perfil']=serialize($usuario);
        header("Location: ../index.php?eventoUnido=true");
    }
    else{
        header("location: ../views/eventos.php?idEventoEmpty=true");
        die();
    }
?>
