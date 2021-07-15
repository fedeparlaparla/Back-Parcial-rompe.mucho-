<?php   

    class Usuario {
          
        public $mail;
        public $user;  
        public $pass; 
        
        public function __construct(){
            
        }

        public function setMail($mail){
            $this->mail=$mail;
        }

        public function getMail(){
            return $this->mail;
        }

        public function setUser($user){
            
            $this->user= $user;
        }

        public function setPass($pass){
            
            $this->pass = $pass;
        }

        public function getUser(){
            
            return $this->user;
        }

        public function getPass(){
            
            return $this->pass;
        }

    
        public static function obtenerTodos(){
            $objAccesoDatos = AccesoDatos::obtenerInstancia();
            $consulta = $objAccesoDatos->prepararConsulta("SELECT mail,user, pass FROM `users`");
            $consulta->execute(array($nombre));
            
                return $consulta->fetchAll(PDO::FETCH_CLASS, 'Usuario');    

        }
        public static function obtenerNombre($nombre){
            $objAccesoDatos = AccesoDatos::obtenerInstancia();
            $consulta = $objAccesoDatos->prepararConsulta("SELECT mail,user, pass FROM `users` WHERE user=?");
            $consulta->execute(array($nombre));
 
                return $consulta->fetchAll(PDO::FETCH_CLASS, 'Usuario');

        }

        public static function insertarUsuario($usuario){
             
            $objAccesoDatos = AccesoDatos::obtenerInstancia();
            $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO `users` (`mail`,`user`, `pass`) VALUES (?,?,? )");
           
            $consulta->execute(array($usuario->getUser(), $usuario->getPass()));

        }

        public function compararPass($contrasenaEnArchivo, $contrasenaIngresada){

                $estado = false;
        
                if($contrasenaEnArchivo == $contrasenaIngresada){
                    $estado = true;
                }
        
                return $estado;
        }
        
        
    } 
?>