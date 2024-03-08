<?php
    session_start();
    include_once "database.php";
    include_once "comprobarDatos.php";
    include_once "../models/usuario.php";
     //si el usuario ya esta loggeado redirigirá al index
     comprobar_perfil_nulo($_SESSION['perfil'] ?? null);

    try{
        //comprobamos que el email y password no son nulos
        comprobar_login($_POST['email'],$_POST['password']);
        //los asignamos a variables
        $email=$_POST['email'];
        //ciframos la contraseña
        $password=hash('sha256',$_POST['password']);

        //conectamos a la bbdd
        $conn=new PDO("mysql:host=$server;dbname=$db",$user,$pwd);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //seleccionamos el todo menos la contraseña del usuario utilizando el email y contraseña
        $query="SELECT correo,nick,nombre,apellidos,karma,suscritoNewsletter FROM usuarios WHERE correo = :correo AND password = :password";
	    $stmt=$conn->prepare($query);
        $stmt->bindParam(':correo',$email);
        $stmt->bindParam(':password',$password);
	    $stmt->execute();
        $login=$stmt->fetch(PDO::FETCH_ASSOC);
        //si la consulta nos devuelve un usuario empezamos la sesion, le asignamos el nick y redirigimos al login
        if(!empty($login))
        {
            //creamos el objeto y lo guardamos en una sesión, sin guardar la contraseña por su puesto
            $perfil=new Usuario($login['nombre'],$login['apellidos'],$login['correo'],$login['nick'],$login['karma'],$login['suscritoNewsletter'],null);

            //Seleccionamos los usuarios que han participado en eventos y los filtraremos por el nick del usuario loggeado
            $query="SELECT evento FROM asistentes WHERE nick=:nickname";
            $stmt=$conn->prepare($query);
            $stmt->bindParam(':nickname',$login['nick']);
            $stmt->execute();
            $asistentes=$stmt->fetchAll(PDO::FETCH_ASSOC);
            //si hay algun usuario con el nick en la tabla de asistentes cogemos el id para coger el evento donde ha participado el usuario
            if(!empty($asistentes))
            {
                //por cada asistencia se busca el evento, se crea un objeto y se añade al array de eventos del usuario
                foreach($asistentes as $evento)
                {
                    //query para eventos
                    $query="SELECT id,nombre,fecha,ubicacion,anfitrion,tipo_evento FROM eventos WHERE id = :id";
                    $stmtEventos=$conn->prepare($query);
                    $stmtEventos->bindParam(':id',$evento['evento']);
                    $stmtEventos->execute();
                    $resultado=$stmtEventos->fetch(PDO::FETCH_ASSOC);
                    if(!empty($resultado))
                    {
                        //query para la cantidad de participantes 
                        $query="SELECT COUNT(*) FROM asistentes WHERE evento=:id";
                        $stmtParticipantes=$conn->prepare($query);
                        $stmtParticipantes->bindParam(':id',$resultado['id']);
                        $stmtParticipantes->execute();
                        $participantes=$stmtParticipantes->fetch(PDO::FETCH_ASSOC);
                        
                        //añadimos el evento con sus participantes al array de eventos del usuario
                        $perfil->addEvento(new Evento($resultado['id'],$resultado['nombre'],$resultado['fecha'],$resultado['ubicacion'],$resultado['anfitrion'],$resultado['tipo_evento'],$participantes['COUNT(*)']));
                    }
                }
            }
            //una vez se han añadido todos los eventos en los que ha participado el usuario se guarda el objeto usuario en la session "perfil" y se redirige al index
            $_SESSION['perfil']=serialize($perfil);
            header("Location: ../index.php");
        }
        //si la consulta no devuelve nada redirigimos a la pagina de login con un error de inicio de sesion a true
        else if(empty($login)){
            header("Location: ../views/loginUsuario.php?errorLog=true");
        }
        //si por algún casual la consulta devuelve mas de 1 salta error al index
        else{
            header("Location: ../index.php?errorUnkown=true");
        }
    }catch(PDOException $e)
    {
        header("Refresh: 5; URL=../index.php");
        die('Error en la conexion '.$e->getMessage());
    }finally{
        $conn=null;
    }
?>
