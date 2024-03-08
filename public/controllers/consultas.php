<?php
    include_once "database.php";
    include_once "../models/usuario.php";
    try{
        //si el valor es null devolvemos al formulario de consultas indicando el error
        if(!isset($_POST['valor']))
        {
            header("Location: ../views/consultaUsuarios.php?valorEmpty=true");
        }
        //si el valor no es numérico y el tipo es karma (numérico) devolvemos al formulario con el error
        if(!is_int($_POST['valor']) && $_POST['tipo']=='karma')
        {
            header("Location:../views/consultaUsuarios.php?valorInt=true");
        }
        session_start();
        $valor=trim($_POST['valor']);
        $tipo=$_POST['tipo'];

        //conectamos a la bbdd
        $conn=new PDO("mysql:host=$server;dbname=$db",$user,$pwd);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //seleccionamos el nickname, email y karma del usuario
        $query=null;
        //si el tipo es karma se buscará por el valor indicado o menos
        if($tipo=="karma")
        {
            $valor=intval($valor);
            $query="SELECT correo, nick, karma FROM usuarios WHERE karma <= :valor";
        }
        else{
            $query="SELECT correo, nick, karma FROM usuarios WHERE  $tipo = :valor";
        }
        $stmt=$conn->prepare($query);
        $stmt->bindParam(':valor',$valor);
        $stmt->execute();
        //se guardan los usuarios que se encontraron en una sesión y se redirige a la pagina para mostrarlos 
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['usuarios']=$usuarios;
        header("Location: ../views/muestraUsuarios.php");
        die();
    }catch(PDOException $e)
    {
        //si algo va mal se muestra el error y se redirige a la pagina principal
        header("Refresh: 5; URL=../index.php");
        die('Error en la conexion '.$e->getMessage());
    }finally{
        $conn=null;
    }
?>
