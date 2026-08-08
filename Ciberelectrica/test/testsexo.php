<?php
// importamos Sexo
require_once '../models/Sexo.php';

// creamos un objeto de Sexo
$modelo = new Sexo();

// Listado de sexos habilitados
echo "<h2>Listado de Sexos Habilitados</h2>";

$resultado = $modelo->findAllCustom();

if ($resultado->num_rows > 0) {

    while ($fila = $resultado->fetch_assoc()) {

        echo "Código: " . $fila['codsex'] .
             " - Nombre: " . $fila['nomsex'] .
             " - Estado: " . ($fila['estsex'] ? 'Habilitado' : 'Deshabilitado') . "<br>";
    }

} else {

    echo "No hay sexos habilitados";
}

echo "<hr>";

// Listado de todos los sexos
echo "<h2>Listado de Todos los Sexos</h2>";

$resultado = $modelo->findAll();

if ($resultado->num_rows > 0) {

    while ($fila = $resultado->fetch_assoc()) {

        echo "Código: " . $fila['codsex'] .
             " - Nombre: " . $fila['nomsex'] .
             " - Estado: " . ($fila['estsex'] ? 'Habilitado' : 'Deshabilitado') . "<br>";
    }

} else {

    echo "No hay sexos registrados";
}

echo "<hr>";

// Registrar sexo
echo "<h2>Registrar Sexo</h2>";

$nomsex = "Género Experimental";
$estsex = 1;

$resultado = $modelo->add($nomsex, $estsex);

echo $resultado
    ? "Sexo registrado correctamente"
    : "Error al registrar el sexo";

echo "<hr>";

// Buscar sexo por código
echo "<h2>Buscar Sexo por Código</h2>";

$codigo = 1;

$resultado = $modelo->findById($codigo);

if ($resultado->num_rows > 0) {

    $fila = $resultado->fetch_assoc();

    echo "Código: " . $fila['codsex'] .
         " - Nombre: " . $fila['nomsex'] .
         " - Estado: " . ($fila['estsex'] ? 'Habilitado' : 'Deshabilitado');

} else {

    echo "No existe el sexo con código $codigo";
}

echo "<hr>";

// Actualizar sexo
echo "<h2>Actualizar Sexo</h2>";

$codsex = 6; // ejemplo de código existente
$nomsex = "Identidad Actualizada";
$estsex = 1;

$resultado = $modelo->update($codsex, $nomsex, $estsex);

echo $resultado
    ? "Sexo actualizado correctamente"
    : "Error al actualizar el sexo";

echo "<hr>";

// Eliminar sexo (deshabilitar)
echo "<h2>Eliminar Sexo (Deshabilitar)</h2>";

$codsex = 6;

$resultado = $modelo->delete($codsex);

echo $resultado
    ? "Sexo deshabilitado correctamente"
    : "Error al deshabilitar el sexo";

echo "<hr>";

// Habilitar sexo
echo "<h2>Habilitar Sexo</h2>";

$codsex = 6;

$resultado = $modelo->enable($codsex);

echo $resultado
    ? "Sexo habilitado correctamente"
    : "Error al habilitar el sexo";

echo "<hr>";

// Deshabilitar sexo
echo "<h2>Deshabilitar Sexo</h2>";

$codsex = 6;

$resultado = $modelo->disable($codsex);

echo $resultado
    ? "Sexo deshabilitado correctamente"
    : "Error al deshabilitar el sexo";

echo "<hr>";

?>