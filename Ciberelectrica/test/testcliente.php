<?php

// importamos Cliente

require_once '../models/Cliente.php';



// creamos un objeto de Cliente

$modelo = new Cliente();



// Listado de clientes habilitados

echo "<h2>Listado de Clientes habilitados</h2>";

$resultado = $modelo->findAllCustom();



if ($resultado->num_rows > 0) {

  while ($fila = $resultado->fetch_assoc()) {

    echo "Código: " . $fila['codcli'] .

       " - Cliente: " . $fila['apepcli'] . " " . $fila['apemcli'] . ", " . $fila['nomcli'] .

       " - N° Doc: " . $fila['doccli'] . " (" . $fila['nomtipd'] . ")" .

       " - Fec. Registro: " . $fila['feccli'] .

       " - Dirección: " . $fila['dircli'] .

       " - Distrito: " . $fila['nomdis'] .

       " - Teléfono: " . $fila['telcli'] .

       " - Celular: " . $fila['celcli'] .

       " - Correo: " . $fila['corcli'] .

       " - Sexo: " . $fila['nomsex'] .

       " - Estado: " . ($fila['estcli'] ? 'Habilitado' : 'Deshabilitado') . "<br>";

  }

} else {

  echo "No hay clientes habilitados";

}



echo "<hr>";



// Listado de todos los clientes

echo "<h2>Listado de Todos los Clientes</h2>";

$resultado = $modelo->findAll();



if ($resultado->num_rows > 0) {

  while ($fila = $resultado->fetch_assoc()) {

    echo "Código: " . $fila['codcli'] .

       " - Cliente: " . $fila['apepcli'] . " " . $fila['apemcli'] . ", " . $fila['nomcli'] .

       " - N° Doc: " . $fila['doccli'] . " (" . $fila['nomtipd'] . ")" .

       " - Fec. Registro: " . $fila['feccli'] .

       " - Dirección: " . $fila['dircli'] .

       " - Distrito: " . $fila['nomdis'] .

       " - Teléfono: " . $fila['telcli'] .

       " - Celular: " . $fila['celcli'] .

       " - Correo: " . $fila['corcli'] .

       " - Sexo: " . $fila['nomsex'] .

       " - Estado: " . ($fila['estcli'] ? 'Habilitado' : 'Deshabilitado') . "<br>";

  }

} else {

  echo "No hay clientes registrados";

}



echo "<hr>";



// Registrar cliente

echo "<h2>Registrar Cliente</h2>";



$nomcli = "Pedro";

$apepcli = "Ramírez";

$apemcli = "Soto";

$doccli = "99887766";

$feccli = date('Y-m-d');

$dircli = "Av. Grau 111";

$telcli = "1111111";

$celcli = "999111222";

$corcli = "pedro@gmail.com";

$estcli = 1;

$coddis = 1;

$codsex = 1;

$codtipd = 1;



$resultado = $modelo->add(

  $nomcli,

  $apepcli,

  $apemcli,

  $doccli,

  $feccli,

  $dircli,

  $telcli,

  $celcli,

  $corcli,

  $estcli,

  $coddis,

  $codsex,

  $codtipd

);



echo $resultado ? "Cliente registrado correctamente" : "Error al registrar el cliente";



echo "<hr>";



// Buscar cliente por código

echo "<h2>Buscar Cliente por Código</h2>";



$codigo = 1;

$resultado = $modelo->findById($codigo);



if ($resultado->num_rows > 0) {

  $fila = $resultado->fetch_assoc();



  echo "Código: " . $fila['codcli'] .

     " - Cliente: " . $fila['apepcli'] . " " . $fila['apemcli'] . ", " . $fila['nomcli'] .

     " - N° Doc: " . $fila['doccli'] . " (" . $fila['nomtipd'] . ")" .

     " - Fec. Registro: " . $fila['feccli'] .

     " - Dirección: " . $fila['dircli'] .

     " - Distrito: " . $fila['nomdis'] .

     " - Teléfono: " . $fila['telcli'] .

     " - Celular: " . $fila['celcli'] .

     " - Correo: " . $fila['corcli'] .

     " - Sexo: " . $fila['nomsex'] .

     " - Estado: " . ($fila['estcli'] ? 'Habilitado' : 'Deshabilitado');

} else {

  echo "No existe el cliente con código $codigo";

}



echo "<hr>";



// Actualizar cliente

echo "<h2>Actualizar Cliente</h2>";



$codcli = 1;

$nomcli = "Pedro Modificado";

$apepcli = "Ramírez";

$apemcli = "Soto";

$doccli = "99887766";

$feccli = date('Y-m-d');

$dircli = "Av. Grau 111 - Dpto 402";

$telcli = "1111111";

$celcli = "999111222";

$corcli = "pedro_nuevo@gmail.com";

$estcli = 1;

$coddis = 1;

$codsex = 1;

$codtipd = 1;



$resultado = $modelo->update(

  $codcli,

  $nomcli,

  $apepcli,

  $apemcli,

  $doccli,

  $feccli,

  $dircli,

  $telcli,

  $celcli,

  $corcli,

  $estcli,

  $coddis,

  $codsex,

  $codtipd

);



echo $resultado ? "Cliente actualizado correctamente" : "Error al actualizar el cliente";



echo "<hr>";



// Eliminar cliente (deshabilitar)

echo "<h2>Eliminar Cliente</h2>";



$codcli = 1;

$resultado = $modelo->delete($codcli);



echo $resultado ? "Cliente deshabilitado correctamente" : "Error al deshabilitar el cliente";



echo "<hr>";



// Habilitar cliente

echo "<h2>Habilitar Cliente</h2>";



$codcli = 1;

$resultado = $modelo->enable($codcli);



echo $resultado ? "Cliente habilitado correctamente" : "Error al habilitar el cliente";



echo "<hr>";



// Deshabilitar cliente

echo "<h2>Deshabilitar Cliente</h2>";



$codcli = 1;

$resultado = $modelo->disable($codcli);



echo $resultado ? "Cliente deshabilitado correctamente" : "Error al deshabilitar el cliente";



echo "<hr>";

?>