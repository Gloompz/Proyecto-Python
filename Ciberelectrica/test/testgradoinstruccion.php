<?php
// importamos GradoInstruccion
require_once '../models/GradoInstruccion.php';

// creamos un objeto de GradoInstruccion
$modelo = new GradoInstruccion();

// Listado de grados de instrucción habilitados
echo "<h2>Listado de Grados de Instrucción Habilitados</h2>";

$resultado = $modelo->findAllCustom();

if ($resultado->num_rows > 0) {

    while ($fila = $resultado->fetch_assoc()) {

        echo "Código: " . $fila['codgrai'] .
             " - Nombre: " . $fila['nomgrai'] .
             " - Estado: " . ($fila['estgrai'] ? 'Habilitado' : 'Deshabilitado') . "<br>";
    }

} else {

    echo "No hay grados de instrucción habilitados";
}

echo "<hr>";

// Listado de todos los grados de instrucción
echo "<h2>Listado de Todos los Grados de Instrucción</h2>";

$resultado = $modelo->findAll();

if ($resultado->num_rows > 0) {

    while ($fila = $resultado->fetch_assoc()) {

        echo "Código: " . $fila['codgrai'] .
             " - Nombre: " . $fila['nomgrai'] .
             " - Estado: " . ($fila['estgrai'] ? 'Habilitado' : 'Deshabilitado') . "<br>";
    }

} else {

    echo "No hay grados de instrucción registrados";
}

echo "<hr>";

// Registrar grado de instrucción
echo "<h2>Registrar Grado de Instrucción</h2>";

$nomgrai = "Especialización";
$estgrai = 1;

$resultado = $modelo->add($nomgrai, $estgrai);

echo $resultado
    ? "Grado de instrucción registrado correctamente"
    : "Error al registrar el grado de instrucción";

echo "<hr>";

// Buscar grado de instrucción por código
echo "<h2>Buscar Grado de Instrucción por Código</h2>";

$codigo = 1;

$resultado = $modelo->findById($codigo);

if ($resultado->num_rows > 0) {

    $fila = $resultado->fetch_assoc();

    echo "Código: " . $fila['codgrai'] .
         " - Nombre: " . $fila['nomgrai'] .
         " - Estado: " . ($fila['estgrai'] ? 'Habilitado' : 'Deshabilitado');

} else {

    echo "No existe el grado de instrucción con código $codigo";
}

echo "<hr>";

// Actualizar grado de instrucción
echo "<h2>Actualizar Grado de Instrucción</h2>";

$codgrai = 6; // ejemplo de código existente
$nomgrai = "Postgrado";
$estgrai = 1;

$resultado = $modelo->update($codgrai, $nomgrai, $estgrai);

echo $resultado
    ? "Grado de instrucción actualizado correctamente"
    : "Error al actualizar el grado de instrucción";

echo "<hr>";

// Eliminar grado de instrucción (deshabilitar)
echo "<h2>Eliminar Grado de Instrucción (Deshabilitar)</h2>";

$codgrai = 6;

$resultado = $modelo->delete($codgrai);

echo $resultado
    ? "Grado de instrucción deshabilitado correctamente"
    : "Error al deshabilitar el grado de instrucción";

echo "<hr>";

// Habilitar grado de instrucción
echo "<h2>Habilitar Grado de Instrucción</h2>";

$codgrai = 6;

$resultado = $modelo->enable($codgrai);

echo $resultado
    ? "Grado de instrucción habilitado correctamente"
    : "Error al habilitar el grado de instrucción";

echo "<hr>";

// Deshabilitar grado de instrucción
echo "<h2>Deshabilitar Grado de Instrucción</h2>";

$codgrai = 6;

$resultado = $modelo->disable($codgrai);

echo $resultado
    ? "Grado de instrucción deshabilitado correctamente"
    : "Error al deshabilitar el grado de instrucción";

echo "<hr>";

?>