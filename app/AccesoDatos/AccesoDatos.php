<?php

class AccesoDatos{

    private static $objetoAccesoDatos;
    private $objetoPDO;

    public static function ObtenerInstancia(){
        if(!isset(self::$objetoAccesoDatos)){
            self::$objetoAccesoDatos = new AccesoDatos();
        }
        return self::$objetoAccesoDatos;
    }

    private function __construct(){

        try{
            $this->objetoPDO = new PDO('mysql:host=localhost:3306;dbname=users;charset=utf8','','',array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $this->objetoPDO->exec("set character  set utf8");

        }catch(PDOException $e){
            print $e->getMessage();
            die();
        }
        
    }

    public function prepararaConsulta($sql){
        return $this->objetoPDO->prepare($sql);
    }

    public function obtenerUltimoId()
    {
        return $this->objetoPDO->lastInsertId();
    }

    public function __clone()
    {
        trigger_error('ERROR: La clonación de este objeto no está permitida', E_USER_ERROR);
    }
}