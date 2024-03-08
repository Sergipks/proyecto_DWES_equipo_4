<?php
    //funcion para comprobar que el nickname no esté repetido
    function comprobar_nick($nickname,$server,$db,$user,$pwd)
    {
        //se incluye la base de datos y se comprueba que el nick no esta 			vacio
        include_once 'database.php';
        if(!isset($nickname))
        {
            return false;
        }
        try{
            //creamos la query
            $conn=new PDO("mysql:host=$server;dbname=$db",$user,$pwd);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $query="SELECT * FROM usuarios WHERE nick = :nickname";
            $stmt=$conn->prepare($query);
            $stmt->bindParam(':nickname',$nickname);
            $stmt->execute();
            $usuarios=$stmt->fetchAll();
            //si la query da resultados devuelve falso
            if(isset($usuarios))
            {
                return false;
            }
            //si no devuelve verdadero
            else{
                return true;
            }
        }catch(PDOException $e)
        {
            //si algo malo pasa muestra error y redirige al index
            header("Refresh: 5; URL=../index.php");
            die('Error en la conexion '.$e->getMessage());
        }finally{
            $conn=null;
        }
    }
    //funcion para comprobar el login de usuarios
    function comprobar_login($email,$password)
    {
        $emailEmpty=null;
        $passwordEmpty=null;
        $error=false;
        //si el email está vacio $error a true y $emailEmpty
        if(!isset($email))
        {
            $emailEmpty=true;
            $error=true;
        }
        //lo mismo para la password
        if(!isset($password))
        {
            $passwordEmpty=true;
            $error=true;
        }
        //si alguno de los dos ha dado error se guardan en un array y se envian por parameto al login de usuario
        if($error)
        {
            $data = http_build_query([
                'emailEmpty'=>$emailEmpty,
                'passwordEmpty'=>$passwordEmpty
            ]);
            header("Location: ../views/loginUsuario.php?". $data);
            die();
        }
    }
    //funcion para comprobar datos de la inserción de usuarios
    function comprobar_datos($email,$nombre,$apellidos,$nickname,$password,$password2)
    {
        $emailFormat=false;
        $passwordFormat=false;
        $passwordNotRepeated=false;
        //se guardan los nombres de las variables
        $campos = ['email', 'nombre', 'apellidos', 'nickname', 'password','password2'];
        
        $error = false;
        
        //si hay campos nulos asigna una variable con el nombre del campo + Empty
        foreach ($campos as $campo)
        {
            //if para checkear si hay algun campo nulo
            if (!isset($$campo))
            {
                $error = true;
            }
            ${$campo . 'Empty'} = !isset($$campo);
        }
        //if para ver si las dos passwords son iguales
        if($password!=$password2)
        {
            $passwordNotRepeated=true;
            $error=true;
        }
        //checkea que el email tenga formato de email
        if (!preg_match('/^\S+@\S+\.\S+$/', $email))
        {
            $emailFormat=true;
            $error=true;
        }

        //checkea que el password sea mayor a 7, tenga mayúsculas y que contenga algun numero
        if(strlen($password)<7 && !preg_match('/[A-Z]/', $password) && !preg_match('/[0-9]/', $password))
        {
            $passwordFormat=true;
            $error=true;
        }
        //si hay algun campo nulo se asigna la variable data con el valor (true=empty / false=llenito) de las variables 
        //creadas en el foreach y redirige al alta de usuarios con dichos errores  
        if ($error)
        {
            $data = http_build_query([
                'emailEmpty' => $emailEmpty,
                'nombreEmpty' => $nombreEmpty,
                'apellidosEmpty' => $apellidosEmpty,
                'nicknameEmpty' => $nicknameEmpty,
                'passwordEmpty' => $passwordEmpty,
                'passwordEmpty2'=>$password2Empty,
                'passwordFormat'=> $passwordFormat,
                'emailFormat'=> $emailFormat,
                'passwordNotRepeated'=>$passwordNotRepeated
            ]);
            header("Location: ../views/altaUsuario.php?" . $data);
            die();
        }
    }
    //funcion para comprobar que el query de usuarios no contenga email o nickname del nuevo usuario
    function comprobar_repetido($usuarios,$email,$nickname)
    {
        //si el no está vacio (se han encontrado algun dato con el email o nickname nuevo) entra
        if(isset($usuarios))
        {
            $emailRepeated=false;
            $nicknameRepeated=false;
            //si el array de usuarios contiene el email nuevo se guarda el error
            if($usuarios['correo']==$email)
            {
                $emailRepeated=true;
            }
            //si el nicknmae se encuentra salta el error
            if($usuarios['nick']==$nickname)
            {
                $nicknameRepeated=true;
            }
            //se guardan los datos que se han encontrado repetidos y se envia al alta de usuario
            $data=http_build_query([
                'emailRepeated'=>$emailRepeated,
                'nicknameRepeated'=>$nicknameRepeated
            ]);
            header("Location:../views/altaUsuario.php?".$data);
            die();
        }
    }
    //funcion para comprobar que se ha realizado algún cambio, que los campos no estén vacios, 
    //que compruebe que el nickname no está repetido
    function comprobar_cambio($usuario,$nombre,$apellidos,$nickname,$server,$db,$user,$pwd)
    {
        $apellidosEmpty=false;
        $nombreEmpty=false;
        $error=false;
        //si el nombre o apellidos estan vacios $error=true
        if(!isset($nombre))
        {
            $nombreEmpty=true;
            $error=true;
        }
        if(!isset($apellidos))
        {
            $apellidosEmpty=true;
            $error=true;
        }
        //si $error=true forma la url con los errores a true y redirige al formulario de modificar perfil
        if($error)
        {
            $data=http_build_query([
                'apellidosEmpty'=>$apellidosEmpty,
                'nicknameEmpty'=>$nicknameEmpty,
                'nombreEmpty'=>$nombreEmpty,
                'nicknameRepeated'=>$nicknameRepeated
            ]);
            header("Location: ../views/modificarPerfil.php?".$data);
            die();
        }
    }
    //funcion para comprobar las contraseñas a la hora de cambiar la contraseña del usuario
    function comprobar_password($password1,$password2,$password3)
    {
        $password1Empty=false;
        $password2Empty=false;
        $passwordFormat=false;
        $passwordNotRepeated=false;
        $error=false;
        //si alguna de las 3 está vacia salta el error
        if(!isset($password1))
        {
            $password1Empty=true;
            $error=true;
        }
        if(!isset($password2))
        {
            $password2Empty=true;
            $error=true;
        }
        if(!isset($password3))
        {
            $password2Empty=true;
            $error=true;
        }
        //si las contraseñas nuevas no coinciden salta error
        if($password2!=$password3)
        {
            $passwordNotRepeated=true;
        }
        //si la nueva contraseña no cumple con el formato salta el error
        if(strlen($password2)<7 && !preg_match('/[A-Z]/', $password2) && !preg_match('/[0-9]/', $password2))
        {
            $passwordFormat=true;
            $error=true;
        }
        //si hay algún error redirige al formulario de cambio de contraseña con los errores
        if($error)
        {
            $data=http_build_query([
                'passwordEmpty'=>$password1Empty,
                'passwordEmpty2'=>$password2Empty,
                'passwordFormat'=>$passwordFormat,
                'passwordNotRepeated'=>$passwordNotRepeated
            ]);
            header("Location: ../views/passwordUsuario.php?".$data);
            die();
        }
    }
    //function para saber si el usuario está loggeado
    function comprobar_perfil($perfil)
    {
        if(!isset($perfil) || empty($perfil))
        {
            header("Location: ../views/loginUsuario.php?notLogged=true");
            die();
        }
    }
    function comprobar_perfil_nulo($perfil)
    {
        if(isset($perfil))
        {
            header("Location: ../index.php?errorLogged=true");
            die();
        }
    }
?>
