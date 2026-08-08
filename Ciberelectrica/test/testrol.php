<?php
// importamos Rol
require_once '../models/Rol.php';

// creamos un objeto de Rol
$modelo = new Rol();

// Listado de roles habilitados
echo "<h2>Listado de Roles Habilitados</h2>";

$resultado = $modelo->findAllCustom();

if ($resultado->num_rows > 0) {

    while ($fila = $resultado->fetch_assoc()) {

        echo "Código: " . $fila['codrol'] .
             " - Nombre: " . $fila['nomrol'] .
             " - Estado: " . ($fila['estrol'] ? 'Habilitado' : 'Deshabilitado') . "<br>";
    }

} else {

    echo "No hay roles habilitados";
}

echo "<hr>";

// Listado de todos los roles
echo "<h2>Listado de Todos los Roles</h2>";

$resultado = $modelo->findAll();

if ($resultado->num_rows > 0) {

    while ($fila = $resultado->fetch_assoc()) {

        echo "Código: " . $fila['codrol'] .
             " - Nombre: " . $fila['nomrol'] .
             " - Estado: " . ($fila['estrol'] ? 'Habilitado' : 'Deshabilitado') . "<br>";
    }

} else {

    echo "No hay roles registrados";
}

echo "<hr>";

// Registrar rol
echo "<h2>Registrar Rol</h2>";

$nomrol = "Supervisor";
$estrol = 1;

$resultado = $modelo->add($nomrol, $estrol);

echo $resultado 
    ? "Rol registrado correctamente" 
    : "Error al registrar el rol";

echo "<hr>";

// Buscar rol por código
echo "<h2>Buscar Rol por Código</h2>";

$codigo = 1;

$resultado = $modelo->findById($codigo);

if ($resultado->num_rows > 0) {

    $fila = $resultado->fetch_assoc();

    echo "Código: " . $fila['codrol'] .
         " - Nombre: " . $fila['nomrol'] .
         " - Estado: " . ($fila['estrol'] ? 'Habilitado' : 'Deshabilitado');

} else {

    echo "No existe el rol con código $codigo";
}

echo "<hr>";

// Actualizar rol
echo "<h2>Actualizar Rol</h2>";

$codrol = 6; // ejemplo de código existente
$nomrol = "Supervisor General";
$estrol = 1;

$resultado = $modelo->update($codrol, $nomrol, $estrol);

echo $resultado 
    ? "Rol actualizado correctamente" 
    : "Error al actualizar el rol";

echo "<hr>";

// Eliminar rol (deshabilitar)
echo "<h2>Eliminar Rol (Deshabilitar)</h2>";

$codrol = 6;

$resultado = $modelo->delete($codrol);

echo $resultado 
    ? "Rol deshabilitado correctamente" 
    : "Error al deshabilitar el rol";

echo "<hr>";

// Habilitar rol
echo "<h2>Habilitar Rol</h2>";

$codrol = 6;

$resultado = $modelo->enable($codrol);

echo $resultado 
    ? "Rol habilitado correctamente" 
    : "Error al habilitar el rol";

echo "<hr>";

// Deshabilitar rol
echo "<h2>Deshabilitar Rol</h2>";

$codrol = 6;

$resultado = $modelo->disable($codrol);

echo $resultado 
    ? "Rol deshabilitado correctamente" 
    : "Error al deshabilitar el rol";

echo "<hr>";

?>