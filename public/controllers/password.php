<?php
    //incluimos las funciones de comprobar datos y los datos para conectar a la bbdd
    include_once "database.php";
    include_once "comprobarDatos.php";
    include_once "../models/usuario.php";
    //recogemos las contraseñas y comprobamos sus requisitos
    $password1=$_POST['password1'];
    $password2=$_POST['password3'];
    $password3=$_POST['password2'];
    comprobar_password($password1,$password2,$password3);
    //conseguimos al usuario loggeado y si no lo está redirige al formulario de login
    session_start();
    comprobar_perfil($_SESSION['perfil']);

    $usuario=unserialize($_SESSION['perfil']);
    $nickUsuario=$usuario->getNickname();
    //ciframos la contraseña y buscamos al usuario con esa contraseña
    $password1=hash("sha256",$password1);

    //conectamos a la bbdd
    $conn=new PDO("mysql:host=$server;dbname=$db",$user,$pwd);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //seleccionamos el todo menos la contraseña del usuario utilizando el email y contraseña
    $query="SELECT nick FROM usuarios WHERE nick= :nick AND password = :password";
    $stmt=$conn->prepare($query);
    $stmt->bindParam(':nick',$nickUsuario);
    $stmt->bindParam(':password',$password1);
    $stmt->execute();
    $login=$stmt->fetch(PDO::FETCH_ASSOC);
    //si la consulta devuelve 1 usuario entra
    if(!empty($login))
    {
        $password2=hash("sha256",$password2);
        $query = "UPDATE usuarios SET password= :password WHERE nick = :nick";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':password', $password2);
        $stmt->bindParam(':nick', $nickUsuario);
        $stmt->execute();

        //si todo ha ido bien, el objeto usuario se actualiza con los nuevos datos, se le asigna el nuevo objeto a la sesion y
        //se redirige al perfil del usuario
        if($stmt->rowCount() >0 )
        {
            header("Location: ../views/perfil.php?passwordChanged=true");
            die();
        }
        //si algo ha fallado se devuelve al perfil :()
        else{
            header("Location: ../views/perfil.php?errorPassword=true");
            die();
        }
    }
    //si no es que la contraseña es incorrecta y devuelve al formulario de cambio de contraseña
    else if(empty($login)){
        header("Location: ../views/passwordUsuario.php?passwordIncorrect=true");
    }
    //si devuelve mas de un campo salta error al index
    else{
        header("Location: ../index.php?errorUnkown=true");
    }
?>
