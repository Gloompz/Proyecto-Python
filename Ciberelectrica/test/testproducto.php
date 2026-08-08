
<?php
// importamos Producto
require_once '../models/Producto.php';


// creamos un objeto de Producto
$modelo = new Producto();


// Listado de productos habilitados
echo "<h2>Listado de Productos habilitados</h2>";
$resultado = $modelo->findAllCustom();


if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "Código: " . $fila['codpro'] .
             " - Producto: " . $fila['nompro'] .
             " - Descripción: " . $fila['despro'] .
             " - Fecha Ingreso: " . $fila['fecing'] .
             " - Precio: S/ " . $fila['prepro'] .
             " - Cantidad: " . $fila['canpro'] .
             " - Marca: " . $fila['nommar'] .
             " - Categoría: " . $fila['nomcat'] .
             " - Estado: " . ($fila['estpro'] ? 'Habilitado' : 'Deshabilitado') . "<br>";
    }
} else {
    echo "No hay productos habilitados";
}


echo "<hr>";


// Listado de todos los productos
echo "<h2>Listado de Todos los Productos</h2>";
$resultado = $modelo->findAll();


if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "Código: " . $fila['codpro'] .
             " - Producto: " . $fila['nompro'] .
             " - Descripción: " . $fila['despro'] .
             " - Fecha Ingreso: " . $fila['fecing'] .
             " - Precio: S/ " . $fila['prepro'] .
             " - Cantidad: " . $fila['canpro'] .
             " - Marca: " . $fila['nommar'] .
             " - Categoría: " . $fila['nomcat'] .
             " - Estado: " . ($fila['estpro'] ? 'Habilitado' : 'Deshabilitado') . "<br>";
    }
} else {
    echo "No hay productos registrados";
}


echo "<hr>";


// Registrar producto
echo "<h2>Registrar Producto</h2>";


$nompro = "Producto de Prueba";
$despro = "Producto registrado desde el archivo de prueba";
$fecing = date('Y-m-d');
$prepro = 120.50;
$canpro = 20;
$estpro = 1;
$codmar = 1;
$codcat = 1;


$resultado = $modelo->add(
    $nompro,
    $despro,
    $fecing,
    $prepro,
    $canpro,
    $estpro,
    $codmar,
    $codcat
);


echo $resultado ? "Producto registrado correctamente" : "Error al registrar el producto";


echo "<hr>";


// Buscar producto por código
echo "<h2>Buscar Producto por Código</h2>";


$codigo = 1;
$resultado = $modelo->findById($codigo);


if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();


    echo "Código: " . $fila['codpro'] .
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


$codpro = 1;
$resultado = $modelo->delete($codpro);


echo $resultado ? "Producto deshabilitado correctamente" : "Error al deshabilitar el producto";


echo "<hr>";


// Habilitar producto
echo "<h2>Habilitar Producto</h2>";


$codpro = 1;
$resultado = $modelo->enable($codpro);


echo $resultado ? "Producto habilitado correctamente" : "Error al habilitar el producto";


echo "<hr>";


// Deshabilitar producto
echo "<h2>Deshabilitar Producto</h2>";


$codpro = 1;
$resultado = $modelo->disable($codpro);


echo $resultado ? "Producto deshabilitado correctamente" : "Error al deshabilitar el producto";


echo "<hr>";
?>

