<?php
//$nombre_especifico -> variables
//Creamos una clase para poder realizar la conexion
class Conexion{
    //servidor de la base de datos
    private $host="localhost";
    //usuario de la base de datos
    private $usuario="root";
    //clave de la base de datos
    private $clave="root";
    //base de datos
    private $base="bdciberelectrik20261";

    //creamos una funcion para conectar
    public function Conectar():mysqli{
        $conexion=new mysqli($this->host,$this->usuario,$this->clave,$this->base);
        if($conexion->connect_error){
            die("Error de conexion: ".$conexion->connect_error);
        }
        return $conexion;
    }
}
?>
