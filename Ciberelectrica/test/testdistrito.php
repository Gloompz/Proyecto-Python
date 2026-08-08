<?php
//importamos Distrito
require_once '../models/Distrito.php';

//creamos un objeto de Distrito
$modelo = new Distrito();

// Listado de distritos habilitados
echo "<h2>Listado de Distritos habilitados</h2>";
$resultado = $modelo->findAllCustom();
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "Código: " . $fila['coddis'] .
            " - Nombre: " . $fila['nomdis'] .
            " - Estado: " . ($fila['estdis'] ? 'Habilitado' : 'Deshabilitado') . "<br>";
    }
} else {
    echo "No hay distritos habilitados";
}

echo "<hr>";

// Listado de todos los distritos
echo "<h2>Listado de Todos los Distritos</h2>";
$resultado = $modelo->findAll();
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "Código: " . $fila['coddis'] .
            " - Nombre: " . $fila['nomdis'] .
            " - Estado: " . ($fila['estdis'] ? 'Habilitado' : 'Deshabilitado') . "<br>";
    }
} else {
    echo "No hay distritos registrados";
}

echo "<hr>";

// Registrar distrito
echo "<h2>Registrar Distrito</h2>";
$nomdis = "Distrito de Prueba";
$estdis = 1;
$resultado = $modelo->add($nomdis, $estdis);
echo $resultado ? "Distrito registrado correctamente" : "Error al registrar el distrito";

echo "<hr>";


// Buscar distrito por código
echo "<h2>Buscar Distrito por Código</h2>";
$codigo = 15;
$resultado = $modelo->findById($codigo);
if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    echo "Código: " . $fila['coddis'] .
        " - Nombre: " . $fila['nomdis'] .
        " - Estado: " . ($fila['estdis'] ? 'Habilitado' : 'Deshabilitado');
} else {
    echo "No existe el distrito con código $codigo";
}

echo "<hr>";


// Actualizar distrito
echo "<h2>Actualizar Distrito</h2>";
$coddis = 51; // ejemplo de código existente
$nomdis = "Distrito Actualizado";
$estdis = 1;
$resultado = $modelo->update($coddis, $nomdis, $estdis);
echo $resultado ? "Distrito actualizado correctamente" : "Error al actualizar el distrito";

echo "<hr>";

// Eliminar distrito (deshabilitar)
echo "<h2>Eliminar Distrito (Deshabilitar)</h2>";
$coddis = 51;
$resultado = $modelo->delete($coddis);
echo $resultado ? "Distrito deshabilitado correctamente" : "Error al deshabilitar el distrito";

echo "<hr>";

// Habilitar distrito
echo "<h2>Habilitar Distrito</h2>";
$coddis = 51;
$resultado = $modelo->enable($coddis);
echo $resultado ? "Distrito habilitado correctamente" : "Error al habilitar el distrito";

echo "<hr>";

// Deshabilitar distrito
echo "<h2>Deshabilitar Distrito</h2>";
$coddis = 51;
$resultado = $modelo->disable($coddis);
echo $resultado ? "Distrito deshabilitado correctamente" : "Error al deshabilitar el distrito";

echo "<hr>";


?>
