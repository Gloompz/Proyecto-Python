<?php
// importamos Marca
require_once '../models/Marca.php';

// creamos un objeto de Marca
$modelo = new Marca();

// Listado de marcas habilitadas
echo "<h2>Listado de Marcas Habilitadas</h2>";

$resultado = $modelo->findAllCustom();

if ($resultado->num_rows > 0) {

    while ($fila = $resultado->fetch_assoc()) {

        echo "Código: " . $fila['codmar'] .
             " - Nombre: " . $fila['nommar'] .
             " - Estado: " . ($fila['estmar'] ? 'Habilitado' : 'Deshabilitado') . "<br>";
    }

} else {

    echo "No hay marcas habilitadas";
}

echo "<hr>";

// Listado de todas las marcas
echo "<h2>Listado de Todas las Marcas</h2>";

$resultado = $modelo->findAll();

if ($resultado->num_rows > 0) {

    while ($fila = $resultado->fetch_assoc()) {

        echo "Código: " . $fila['codmar'] .
             " - Nombre: " . $fila['nommar'] .
             " - Estado: " . ($fila['estmar'] ? 'Habilitado' : 'Deshabilitado') . "<br>";
    }

} else {

    echo "No hay marcas registradas";
}

echo "<hr>";

// Registrar marca
echo "<h2>Registrar Marca</h2>";

$nommar = "Lenovo";
$estmar = 1;

$resultado = $modelo->add($nommar, $estmar);

echo $resultado
    ? "Marca registrada correctamente"
    : "Error al registrar la marca";

echo "<hr>";

// Buscar marca por código
echo "<h2>Buscar Marca por Código</h2>";

$codigo = 1;

$resultado = $modelo->findById($codigo);

if ($resultado->num_rows > 0) {

    $fila = $resultado->fetch_assoc();

    echo "Código: " . $fila['codmar'] .
         " - Nombre: " . $fila['nommar'] .
         " - Estado: " . ($fila['estmar'] ? 'Habilitado' : 'Deshabilitado');

} else {

    echo "No existe la marca con código $codigo";
}

echo "<hr>";

// Actualizar marca
echo "<h2>Actualizar Marca</h2>";

$codmar = 6; // ejemplo de código existente
$nommar = "Lenovo Gaming";
$estmar = 1;

$resultado = $modelo->update($codmar, $nommar, $estmar);

echo $resultado
    ? "Marca actualizada correctamente"
    : "Error al actualizar la marca";

echo "<hr>";

// Eliminar marca (deshabilitar)
echo "<h2>Eliminar Marca (Deshabilitar)</h2>";

$codmar = 6;

$resultado = $modelo->delete($codmar);

echo $resultado
    ? "Marca deshabilitada correctamente"
    : "Error al deshabilitar la marca";

echo "<hr>";

// Habilitar marca
echo "<h2>Habilitar Marca</h2>";

$codmar = 6;

$resultado = $modelo->enable($codmar);

echo $resultado
    ? "Marca habilitada correctamente"
    : "Error al habilitar la marca";

echo "<hr>";

// Deshabilitar marca
echo "<h2>Deshabilitar Marca</h2>";

$codmar = 6;

$resultado = $modelo->disable($codmar);

echo $resultado
    ? "Marca deshabilitada correctamente"
    : "Error al deshabilitar la marca";

echo "<hr>";

?>