<?php
// importamos EstadoCivil
require_once '../models/EstadoCivil.php';

// creamos un objeto de EstadoCivil
$modelo = new EstadoCivil();

// Listado de estados civiles habilitados
echo "<h2>Listado de Estados Civiles Habilitados</h2>";

$resultado = $modelo->findAllCustom();

if ($resultado->num_rows > 0) {

    while ($fila = $resultado->fetch_assoc()) {

        echo "Código: " . $fila['codestc'] .
             " - Nombre: " . $fila['nomestc'] .
             " - Estado: " . ($fila['estestc'] ? 'Habilitado' : 'Deshabilitado') . "<br>";
    }

} else {

    echo "No hay estados civiles habilitados";
}

echo "<hr>";

// Listado de todos los estados civiles
echo "<h2>Listado de Todos los Estados Civiles</h2>";

$resultado = $modelo->findAll();

if ($resultado->num_rows > 0) {

    while ($fila = $resultado->fetch_assoc()) {

        echo "Código: " . $fila['codestc'] .
             " - Nombre: " . $fila['nomestc'] .
             " - Estado: " . ($fila['estestc'] ? 'Habilitado' : 'Deshabilitado') . "<br>";
    }

} else {

    echo "No hay estados civiles registrados";
}

echo "<hr>";

// Registrar estado civil
echo "<h2>Registrar Estado Civil</h2>";

$nomestc = "Conviviente";
$estestc = 1;

$resultado = $modelo->add($nomestc, $estestc);

echo $resultado
    ? "Estado civil registrado correctamente"
    : "Error al registrar el estado civil";

echo "<hr>";

// Buscar estado civil por código
echo "<h2>Buscar Estado Civil por Código</h2>";

$codigo = 1;

$resultado = $modelo->findById($codigo);

if ($resultado->num_rows > 0) {

    $fila = $resultado->fetch_assoc();

    echo "Código: " . $fila['codestc'] .
         " - Nombre: " . $fila['nomestc'] .
         " - Estado: " . ($fila['estestc'] ? 'Habilitado' : 'Deshabilitado');

} else {

    echo "No existe el estado civil con código $codigo";
}

echo "<hr>";

// Actualizar estado civil
echo "<h2>Actualizar Estado Civil</h2>";

$codestc = 5; // ejemplo de código existente
$nomestc = "Separado";
$estestc = 1;

$resultado = $modelo->update($codestc, $nomestc, $estestc);

echo $resultado
    ? "Estado civil actualizado correctamente"
    : "Error al actualizar el estado civil";

echo "<hr>";

// Eliminar estado civil (deshabilitar)
echo "<h2>Eliminar Estado Civil (Deshabilitar)</h2>";

$codestc = 5;

$resultado = $modelo->delete($codestc);

echo $resultado
    ? "Estado civil deshabilitado correctamente"
    : "Error al deshabilitar el estado civil";

echo "<hr>";

// Habilitar estado civil
echo "<h2>Habilitar Estado Civil</h2>";

$codestc = 5;

$resultado = $modelo->enable($codestc);

echo $resultado
    ? "Estado civil habilitado correctamente"
    : "Error al habilitar el estado civil";

echo "<hr>";

// Deshabilitar estado civil
echo "<h2>Deshabilitar Estado Civil</h2>";

$codestc = 5;

$resultado = $modelo->disable($codestc);

echo $resultado
    ? "Estado civil deshabilitado correctamente"
    : "Error al deshabilitar el estado civil";

echo "<hr>";

?>