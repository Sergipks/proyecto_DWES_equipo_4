<?php
    //incluimos las funciones de comprobar y el fichero de bbdd
    include_once "database.php";
    include_once "comprobarDatos.php";
    include_once "../models/usuario.php";
    try{
        session_start();
        //obtenemos los campos para cambiar
        $nombre=$_POST['nombre'];
        $apellidos=$_POST['apellidos'];
        //comprobamos que el usuario está loggeado, si no redirige al formulario de login
        comprobar_perfil($_SESSION['perfil']);
        //asignamos el perfil de usuario a variable
        $usuario=unserialize($_SESSION['perfil']);
        //asignamos el nickname del usuario
        $nickname=$usuario->getNickname();
        //comprobamos que los datos no estén vacios o el nickname repetido, si hay algún error se redirige al formulario de modificar
        comprobar_cambio($usuario,$nombre, $apellidos,$nickname,$server,$db,$user,$pwd);
        $conn=new PDO("mysql:host=$server;dbname=$db",$user,$pwd);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //actualizamos el usuario
        $query = "UPDATE usuarios SET nombre= :nombre, apellidos = :apellidos WHERE nick = :nick";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nick', $nickname);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->execute();

        //si todo ha ido bien, el objeto usuario se actualiza con los nuevos datos, se le asigna el nuevo objeto a la sesion y
        //se redirige al perfil del usuario
        if($stmt->rowCount() >0 )
        {
            $usuario->setNombre($nombre);
            $usuario->setApellidos($apellidos);
            $_SESSION['perfil']=serialize($usuario);
            header("Location: ../views/perfil.php");
            die();
        }
        //si algo ha fallado se devuelve al formulario de modificacion :(
        else{
            header("Location: ../views/modificarPerfil.php?errorUpdate=true");
            die();
        }
    }catch(PDOException $e){
        //si algo ha ido mal se redirige al index
        header("Refresh: 5; URL=../index.php");
        die('Error en la conexion '.$e->getMessage());
    }finally{
        $conn=null;
    }
?>
