<?php
//importar el archivo database.php
require_once '../config/database.php';
//creamos un objeto de la clase Conexion
$db=new Conexion();
//realizamos la conexion
$xcon=$db->Conectar();
echo"Conexion Exitosa";
?>