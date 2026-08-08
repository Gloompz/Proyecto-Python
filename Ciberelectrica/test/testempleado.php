<?php
// importamos Producto
require_once '../models/Producto.php';


// creamos un objeto de Producto
$modelo = new Empleado();


// Listado de productos habilitados
echo "<h2>Listado de Empleado habilitados</h2>";
$resultado = $modelo->findAllCustom();


if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "Código: " . $fila['codemp'] .
             " - Nombre: " . $fila['nomemp'] .
             " - A. Paterno: " . $fila['apepemp'] .
             " - A. Materno: " . $fila['apememp'] .
             " - Documento: " . $fila['docemp'] .
             " - Fecha: " . $fila['fecemp'] .
             " - Direccion: " . $fila['diremp'] .
             " - Telefono: " . $fila['telemp'] .
             " - Celular: " . $fila['celemp'] .
             " - Correo: " . $fila['coremp'] .
             " - Usuario " . $fila['usuemp'] .
             " - Clave: " . $fila['claemp'] .
             " - Sueldo: " . $fila['sueemp'] .
             " - Fecha Ingreso: " . $fila['fecing'] .
             " - Nombre Especialidad: " . $fila['nomesp'] .
             " - Distrito: " . $fila['coddis'] .
             " - Sexo: " . $fila['codsex'] .
             " - Rol: " . $fila['codrol'] .
             " - Estado Civil: " . $fila['codestc'] .
             " - Grado Instruccion: " . $fila['codgrai'] .
             " - Estado: " . ($fila['estemp'] ? 'Habilitado' : 'Deshabilitado') . "<br>";
    }
} else {
    echo "No hay empleados habilitados";
}


echo "<hr>";


// Listado de todos los productos
echo "<h2>Listado de Todos los Empleado</h2>";
$resultado = $modelo->findAll();


if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
       echo "Código: " . $fila['codemp'] .
             " - Nombre: " . $fila['nomemp'] .
             " - A. Paterno: " . $fila['apepemp'] .
             " - A. Materno: " . $fila['apememp'] .
             " - Documento: " . $fila['docemp'] .
             " - Fecha: " . $fila['fecemp'] .
             " - Direccion: " . $fila['diremp'] .
             " - Telefono: " . $fila['telemp'] .
             " - Celular: " . $fila['celemp'] .
             " - Correo: " . $fila['coremp'] .
             " - Usuario " . $fila['usuemp'] .
             " - Clave: " . $fila['claemp'] .
             " - Sueldo: " . $fila['sueemp'] .
             " - Fecha Ingreso: " . $fila['fecing'] .
             " - Nombre Especialidad: " . $fila['nomesp'] .
             " - Distrito: " . $fila['coddis'] .
             " - Sexo: " . $fila['codsex'] .
             " - Rol: " . $fila['codrol'] .
             " - Estado Civil: " . $fila['codestc'] .
             " - Grado Instruccion: " . $fila['codgrai'] .
             " - Estado: " . ($fila['estemp'] ? 'Habilitado' : 'Deshabilitado') . "<br>";
    }
} else {
    echo "No hay empleado registrados";
}


echo "<hr>";


// Registrar producto
echo "<h2>Registrar Empleado</h2>";


$nomemp = "Empleado de Prueba";
$apepemp = "Empleado registrado desde el archivo de prueba";
$fecing = date('Y-m-d');
$prepro = 120.50;
$canpro = 20;
$estpro = 1;
$codmar = 1;
$codcat = 1;


$resultado = $modelo->add(
    $nomemp,
    $apepemp,
    $apememp,
    $docemp,
    $docemp,
    $canpro,
    $estpro,
    $codmar,
    $codcat
);


echo $resultado ? "Empleado registrado correctamente" : "Error al registrar el Empleado";


echo "<hr>";


// Buscar producto por código
echo "<h2>Buscar Producto por Código</h2>";


$codigo = 1;
$resultado = $modelo->findById($codigo);


if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();


    echo "Código: " . $fila['codemp'] .
         " - Producto: " . $fila['nompro'] .
         " - Descripción: " . $fila['despro'] .
         " - Fecha Ingreso: " . $fila['fecing'] .
         " - Precio: S/ " . $fila['prepro'] .
         " - Cantidad: " . $fila['canpro'] .
         " - Marca: " . $fila['nommar'] .
         " - Categoría: " . $fila['nomcat'] .
         " - Estado: " . ($fila['estpro'] ? 'Habilitado' : 'Deshabilitado');
} else {
    echo "No existe el producto con código $codigo";
}


echo "<hr>";


// Actualizar producto
echo "<h2>Actualizar Producto</h2>";


$codpro = 1;
$nompro = "Producto Actualizado";
$despro = "Descripción actualizada desde el archivo de prueba";
$fecing = date('Y-m-d');
$prepro = 150.90;
$canpro = 35;
$estpro = 1;
$codmar = 1;
$codcat = 1;


$resultado = $modelo->update(
    $codpro,
    $nompro,
    $despro,
    $fecing,
    $prepro,
    $canpro,
    $estpro,
    $codmar,
    $codcat
);


echo $resultado ? "Producto actualizado correctamente" : "Error al actualizar el producto";


echo "<hr>";


// Eliminar producto (deshabilitar)
echo "<h2>Eliminar Producto</h2>";


$codemp = 1;
$resultado = $modelo->delete($codemp);


echo $resultado ? "Producto deshabilitado correctamente" : "Error al deshabilitar el producto";


echo "<hr>";


// Habilitar producto
echo "<h2>Habilitar Producto</h2>";


$codemp = 1;
$resultado = $modelo->enable($codemp);


echo $resultado ? "Producto habilitado correctamente" : "Error al habilitar el producto";


echo "<hr>";


// Deshabilitar producto
echo "<h2>Deshabilitar Producto</h2>";


$codemp = 1;
$resultado = $modelo->disable($codemp);


echo $resultado ? "Producto deshabilitado correctamente" : "Error al deshabilitar el producto";


echo "<hr>";
?>

