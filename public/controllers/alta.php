<?php
    session_start();
    //se incluye los ficheros con los datos y funciones necesarias
    include_once "database.php";
    include_once "comprobarDatos.php";
    
    include_once "../models/usuario.php";
     //si el usuario ya esta loggeado redirigirá al index
     comprobar_perfil_nulo($_SESSION['perfil'] ?? null);
    try{
        //asignamos los valores recibidos a variables
        $email=$_POST['email'];
        $nombre=$_POST['nombre'];
        $apellidos=$_POST['apellidos'];
        $nickname=$_POST['nickname'];
        $password1=$_POST['password'];
        $password2=$_POST['password2'];
        //se comprueba que los datos no sean nulos y cumplan los requisitos
        comprobar_datos($email,$nombre,$apellidos,$nickname,$password1,$password2);
        //conectamos con la base de datos
	    $conn=new PDO("mysql:host=$server;dbname=$db",$user,$pwd);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //intentamos buscar algún usuario con el email o nickname proporcionado
        $query='SELECT correo, nick FROM usuarios WHERE correo = :correo OR nick = :nickname';
	    $stmt=$conn->prepare($query);
        $stmt->bindParam(':correo',$email);
        $stmt->bindParam(':nickname',$nickname);
	    $stmt->execute();
        $usuarios=$stmt->fetch(PDO::FETCH_ASSOC);
        //funcion para verificar si el email o el nickname no están repetidos
        if(!empty($usuarios))
        {
            comprobar_repetido($usuarios,$email,$nickname);
        }
        
        $passwordCifrada=hash('sha256',$password1);
        //query para insertar el nuevo usuario
        $query = 'INSERT INTO usuarios (nick, nombre, apellidos, correo, karma,suscritoNewsletter,password) VALUES (:nickname, :nombre, :apellidos, :correo,0,0, :password)';
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nickname', $nickname);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':correo', $email);
        $stmt->bindParam(':password',$passwordCifrada);

        //si el insert es correcto redirige al index
        if($stmt->execute())
        {
            header("Location: ../index.php?insertado=true");
            die();
        }
        //si falla muestra un error y redirige al index
        {
            echo "<p>Error al insertar el usuario, ".$stmt->errorInfo()[2]."</p>";
            header("Refresh: 5; URL=../index.php");
            die();
        }
    }catch(PDOException $e)
    {
        header("Refresh: 5; URL=../index.php");
        die('Error en la conexion '.$e->getMessage());
    }finally{
        $conn=null;
    }
?>
