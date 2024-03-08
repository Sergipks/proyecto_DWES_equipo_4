<?php
    include_once '../controllers/comprobarDatos.php';
    class Usuario{
        //variables del usuario, almacenando id, nombre, apellidos, email, nickname, karma y si es administrador o no
        private $nombre;
        private $apellidos;
        private $email;
        private $nickname;
        private $karma;
        private $eventos;
        private $administrator;
        private $newsletter;
        //constructor donde se le asignan sus valores y dependiendo de la id que reciva sera o no administrador
        public function __construct($nombre,$apellidos,$email,$nickname,$karma,$newsletter,$eventos)
        {
            $this->nombre=$nombre;
            $this->apellidos=$apellidos;
            $this->email=$email;
            $this->nickname=$nickname;
            $this->karma=$karma;
            $this->newsletter=$newsletter;
            if(isset($eventos) && !empty($eventos))
            {
                $this->eventos=$eventos;
            }
            else{
                $this->eventos=array();
            }
            if($nickname=="admin")
            {
                $this->administrator=true;
            }
            else{
                $this->administrator=false;
            }
        }
        //getters y setters
        public function getNombre()
        {
            return $this->nombre;
        }
        public function getApellidos()
        {
            return $this->apellidos;
        }
        public function getEmail()
        {
            return $this->email;
        }
        public function getNickname()
        {
            return $this->nickname;
        }
        public function getKarma()
        {
            return $this->karma;
        }
        public function setNombre($nombre)
        {
            $this->nombre=$nombre;
        }
        public function setApellidos($apellidos)
        {
            $this->apellidos=$apellidos;
        }
        //funcion para añadir eventos, devuelve true si el objeto es un evento o false si no
        public function addEvento($evento)
        {
            if($evento instanceof evento)
            {
                $this->eventos[]=$evento;
                return true;
            }
            return false;
        }
        //function para devolver los objetos de un usuario
        public function getEventos()
        {
            return $this->eventos;
        }
        public function setNickname($nickname,$server,$db,$user,$pwd)
        {
            if(comprobar_nick($nickname,$server,$db,$user,$pwd))
            {
                $this->nickname=$nickname;
            }
        }
        //function que le añade x karma al usuario segun el evento participado
        public function addKarma($evento)
        {
            $karma=0;
            switch($evento)
            {
                case "reforesta":
                    $karma=4;
                break;
                case "evento":
                    $karma=3;
                break;
                case "blog":
                    $karma=2;
                break;
                case "post":
                    $karma=1;
                break;
            }
            $this->karma+=$karma;
        }
        //funcion que le sustrae x karma al usuario
        public function restKarma($karma)
        {
            $this->karma-=$karma;
        }
    }
    class Evento{
        //atributos de eventos
        private $id;
        private $nombre;
        private $fecha;
        private $participantes;
        private $ubicacion;
        private $anfitrion;
        private $tipoEvento;
    
        //constructor de eventos
        public function __construct($id,$nombre,$fecha,$ubicacion,$anfitrion,$tipoEvento,$participantes)
        {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->fecha = $fecha;
            $this->ubicacion = $ubicacion;
            $this->anfitrion = $anfitrion;
            $this->tipoEvento = $tipoEvento;
            $this->participantes=$participantes;
        }
    
        //getters the eventos
        public function getId()
        {
            return $this->id;
        }
    
        public function getNombre()
        {
            return $this->nombre;
        }
    
        public function getFecha()
        {
            return $this->fecha;
        }
    
        public function getParticipantes()
        {
            return $this->participantes;
        }
    
        public function getUbicacion()
        {
            return $this->ubicacion;
        }
    
        public function getAnfitrion()
        {
            return $this->anfitrion;
        }
    
        public function getTipoEvento()
        {
            return $this->tipoEvento;
        }
    }
?>
