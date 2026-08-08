<?php
//importamos Distrito
require_once '../models/TipoDocumento.php';

//creamos un objeto de Distrito
$modelo = new TipoDocumento();

// Listado de distritos habilitados
echo "<h2>Listado de Tipo de Documento habilitados</h2>";
$resultado = $modelo->findAllCustom();
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "Código: " . $fila['codtipd'] .
            " - Nombre: " . $fila['nomtipd'] .
            " - Estado: " . ($fila['esttipd'] ? 'Habilitado' : 'Deshabilitado') . "<br>";
    }
} else {
    echo "No hay Tipo de Documento habilitados";
}

echo "<hr>";

// Listado de todos los distritos
echo "<h2>Listado de Todos los Tipo de Documento</h2>";
$resultado = $modelo->findAll();
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "Código: " . $fila['codtipd'] .
            " - Nombre: " . $fila['nomtipd'] .
            " - Estado: " . ($fila['esttipd'] ? 'Habilitado' : 'Deshabilitado') . "<br>";
    }
} else {
    echo "No hay Tipo de Documento registrados";
}

echo "<hr>";

// Registrar distrito
echo "<h2>Registrar Tipo de Documento</h2>";
$nomtipd = "Tipo de Documento de Prueba";
$esttipd = 1;
$resultado = $modelo->add($nomtipd, $esttipd);
echo $resultado ? "Tipo de Documento registrado correctamente" : "Error al registrar el Tipo de Documento";

echo "<hr>";


// Buscar distrito por código
echo "<h2>Buscar Tipo de Documento por Código</h2>";
$codigo = 15;
$resultado = $modelo->findById($codigo);
if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    echo "Código: " . $fila['codtipd'] .
        " - Nombre: " . $fila['nomtipd'] .
        " - Estado: " . ($fila['esttipd'] ? 'Habilitado' : 'Deshabilitado');
} else {
    echo "No existe el Tipo de Documento con código $codigo";
}

echo "<hr>";


// Actualizar distrito
echo "<h2>Actualizar Tipo de Documento</h2>";
$codtipd = 5; // ejemplo de código existente
$nomtipd = "Distrito Actualizado";
$esttipd = 1;
$resultado = $modelo->update($codtipd, $nomtipd, $esttipd);
echo $resultado ? "Tipo de Documento actualizado correctamente" : "Error al actualizar el Tipo de Documento";

echo "<hr>";

// Eliminar distrito (deshabilitar)
echo "<h2>Eliminar Tipo de Documento (Deshabilitar)</h2>";
$codtipd = 5;
$resultado = $modelo->delete($codtipd);
echo $resultado ? "Tipo de Documento deshabilitado correctamente" : "Error al deshabilitar el Tipo de Documento";

echo "<hr>";

// Habilitar distrito
echo "<h2>Habilitar Tipo de Documento</h2>";
$codtipd = 5;
$resultado = $modelo->enable($codtipd);
echo $resultado ? "Tipo de Documento habilitado correctamente" : "Error al habilitar el Tipo de Documento";

echo "<hr>";

// Deshabilitar distrito
echo "<h2>Deshabilitar Distrito</h2>";
$codtipd = 5;
$resultado = $modelo->disable($codtipd);
echo $resultado ? "Tipo de Documento deshabilitado correctamente" : "Error al deshabilitar el Tipo de Documento";

echo "<hr>";


?>
