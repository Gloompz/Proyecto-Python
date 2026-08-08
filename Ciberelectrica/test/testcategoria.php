<?php
// importamos Categoria
require_once '../Models/Categoria.php';

// creamos un objeto de Categoria
$modelo = new Categoria();

// Listado de categorías habilitadas
echo "<h2>Listado de Categorías Habilitadas</h2>";

$resultado = $modelo->findAllCustom();

if ($resultado->num_rows > 0) {

    while ($fila = $resultado->fetch_assoc()) {

        echo "Código: " . $fila['codcat'] .
             " - Nombre: " . $fila['nomcat'] .
             " - Estado: " . ($fila['estcat'] ? 'Habilitado' : 'Deshabilitado') . "<br>";
    }

} else {

    echo "No hay categorías habilitadas";
}

echo "<hr>";

// Listado de todas las categorías
echo "<h2>Listado de Todas las Categorías</h2>";

$resultado = $modelo->findAll();

if ($resultado->num_rows > 0) {

    while ($fila = $resultado->fetch_assoc()) {

        echo "Código: " . $fila['codcat'] .
             " - Nombre: " . $fila['nomcat'] .
             " - Estado: " . ($fila['estcat'] ? 'Habilitado' : 'Deshabilitado') . "<br>";
    }

} else {

    echo "No hay categorías registradas";
}

echo "<hr>";

// Registrar categoría
echo "<h2>Registrar Categoría</h2>";

$nomcat = "Videojuegos";
$estcat = 1;

$resultado = $modelo->add($nomcat, $estcat);

echo $resultado
    ? "Categoría registrada correctamente"
    : "Error al registrar la categoría";

echo "<hr>";

// Buscar categoría por código
echo "<h2>Buscar Categoría por Código</h2>";

$codigo = 1;

$resultado = $modelo->findById($codigo);

if ($resultado->num_rows > 0) {

    $fila = $resultado->fetch_assoc();

    echo "Código: " . $fila['codcat'] .
         " - Nombre: " . $fila['nomcat'] .
         " - Estado: " . ($fila['estcat'] ? 'Habilitado' : 'Deshabilitado');

} else {

    echo "No existe la categoría con código $codigo";
}

echo "<hr>";

// Actualizar categoría
echo "<h2>Actualizar Categoría</h2>";

$codcat = 1;
$nomcat = "Electrónica";
$estcat = 1;

$resultado = $modelo->update($codcat, $nomcat, $estcat);

echo $resultado
    ? "Categoría actualizada correctamente"
    : "Error al actualizar la categoría";

echo "<hr>";

// Eliminar categoría (deshabilitar)
echo "<h2>Eliminar Categoría (Deshabilitar)</h2>";

$codcat = 1;

$resultado = $modelo->delete($codcat);

echo $resultado
    ? "Categoría deshabilitada correctamente"
    : "Error al deshabilitar la categoría";

echo "<hr>";

// Habilitar categoría
echo "<h2>Habilitar Categoría</h2>";

$codcat = 1;

$resultado = $modelo->enable($codcat);

echo $resultado
    ? "Categoría habilitada correctamente"
    : "Error al habilitar la categoría";

echo "<hr>";

// Deshabilitar categoría
echo "<h2>Deshabilitar Categoría</h2>";

$codcat = 1;

$resultado = $modelo->disable($codcat);

echo $resultado
    ? "Categoría deshabilitada correctamente"
    : "Error al deshabilitar la categoría";

echo "<hr>";

?>