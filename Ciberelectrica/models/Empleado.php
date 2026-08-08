<?php
require_once '../config/database.php';

class Empleado
{
    private $xcon;

    public function __construct()
    {
        $db = new Conexion();
        $this->xcon = $db->Conectar();
    }

    // Listar clientes habilitados con paginación
    public function findAllCustomPaginated($inicio, $limite)
    {   
        $sql = "SELECT
                    e.codemp, e.nomemp, e.apepemp, e.apememp, e.docemp, e.fecemp, e.diremp,
                    e.telemp, e.celemp, e.coremp, e.usuemp, e.claemp, e.sueemp, e.fecing, e.nomesp, e.estemp, e.coddis, e.codsex, e.codrol, e.codtipd, e.codestc, e.codgrai,
                    d.nomdis, s.nomsex, r.nomrol, t.nomtipd, ec.nomestc, g.nomgrai
                FROM empleado e
                INNER JOIN distrito d ON e.coddis = d.coddis
                INNER JOIN sexo s ON e.codsex = s.codsex
                INNER JOIN rol r ON e.codrol = r.codrol
                INNER JOIN tipodocumento t ON e.codtipd = t.codtipd
                INNER JOIN estadocivil ec ON e.codestc = ec.codestc
                INNER JOIN gradoinstruccion g ON e.codgrai = g.codgrai
                ORDER BY e.codemp ASC
                LIMIT ?, ?";

        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('ii', $inicio, $limite);
        $stmt->execute();

        return $stmt->get_result();
    }

    // Contar clientes habilitados
    public function countAllCustom()
    {
        $sql = "SELECT COUNT(*) AS total FROM empleado WHERE estemp = 1";
        $resultado = $this->xcon->query($sql);
        $fila = $resultado->fetch_assoc();

        return $fila['total'];
    }

    // Listar todos los clientes con paginación
    public function findAllPaginated($inicio, $limite)
    {
        $sql = "SELECT
                    e.codemp, e.nomemp, e.apepemp, e.apememp, e.docemp, e.fecemp, e.diremp,
                    e.telemp, e.celemp, e.coremp, e.usuemp, e.claemp, e.sueemp, e.fecing, e.nomesp, e.estemp, e.coddis, e.codsex, e.codrol, e.codtipd, e.codestc, e.codgrai,
                    d.nomdis, s.nomsex, r.nomrol, t.nomtipd, ec.nomestc, g.nomgrai
                FROM empleado e
                INNER JOIN distrito d ON e.coddis = d.coddis
                INNER JOIN sexo s ON e.codsex = s.codsex
                INNER JOIN rol r ON e.codrol = r.codrol
                INNER JOIN tipodocumento t ON e.codtipd = t.codtipd
                INNER JOIN estadocivil ec ON e.codestc = ec.codestc
                INNER JOIN gradoinstruccion g ON e.codgrai = g.codgrai
                ORDER BY e.codemp ASC
                LIMIT ?, ?";

        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('ii', $inicio, $limite);
        $stmt->execute();

        return $stmt->get_result();
    }

    // Contar todos los clientes
    public function countAll()
    {
        $sql = "SELECT COUNT(*) AS total FROM empleado";
        $resultado = $this->xcon->query($sql);
        $fila = $resultado->fetch_assoc();

        return $fila['total'];
    }

    // Listar clientes habilitados (sin paginación)
    public function findAllCustom()
    {
        $sql = "SELECT
                    e.codemp, e.nomemp, e.apepemp, e.apememp, e.docemp, e.fecemp, e.diremp,
                    e.telemp, e.celemp, e.coremp, e.usuemp, e.claemp, e.sueemp, e.fecing, e.nomesp, e.estemp, e.coddis, e.codsex, e.codrol, e.codtipd, e.codestc, e.codgrai,
                    d.nomdis, s.nomsex, r.nomrol, t.nomtipd, ec.nomestc, g.nomgrai
                FROM empleado e
                INNER JOIN distrito d ON e.coddis = d.coddis
                INNER JOIN sexo s ON e.codsex = s.codsex
                INNER JOIN rol r ON e.codrol = r.codrol
                INNER JOIN tipodocumento t ON e.codtipd = t.codtipd
                INNER JOIN estadocivil ec ON e.codestc = ec.codestc
                INNER JOIN gradoinstruccion g ON e.codgrai = g.codgrai
                WHERE e.estemp = 1
                ORDER BY e.codemp ASC"; 

        return $this->xcon->query($sql);
    }

    // Listar todos los clientes (sin paginación)
    public function findAll()
    {
        $sql = "SELECT
                    e.codemp, e.nomemp, e.apepemp, e.apememp, e.docemp, e.fecemp, e.diremp,
                    e.telemp, e.celemp, e.coremp, e.usuemp, e.claemp, e.sueemp, e.fecing, e.nomesp, e.estemp, e.coddis, e.codsex, e.codrol, e.codtipd, e.codestc, e.codgrai,
                    d.nomdis, s.nomsex, r.nomrol, t.nomtipd, ec.nomestc, g.nomgrai
                FROM empleado e
                INNER JOIN distrito d ON e.coddis = d.coddis
                INNER JOIN sexo s ON e.codsex = s.codsex
                INNER JOIN rol r ON e.codrol = r.codrol
                INNER JOIN tipodocumento t ON e.codtipd = t.codtipd
                INNER JOIN estadocivil ec ON e.codestc = ec.codestc
                INNER JOIN gradoinstruccion g ON e.codgrai = g.codgrai
                ORDER BY e.codemp DESC"; 

        return $this->xcon->query($sql);
    }

    // Registrar cliente
    public function add($nombre, $apellidopaterno, $apellidomaterno, $documento, $fecha, $direccion, $telefono, $celular, $correo, $usuario, $clave, $sueldo, $fechaingreso, $especialidad, $estado,                $codigodistrito, $codigosexo, $codigorol, $codigotipodocumento, $codigoestadocivil, $codigogradoinstruccion)
    {
        $sql = "INSERT INTO empleado
                (nomemp, apepemp, apememp, docemp, fecemp, diremp, telemp, celemp, coremp, usuemp, claemp, sueemp, fecing, nomesp, estemp, coddis, codsex, codrol, codtipd, codestc, codgrai)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param(
            'sssssssssssdssiiiiiii',
            $nombre,
            $apellidopaterno,
            $apellidomaterno,
            $documento,
            $fecha,
            $direccion,
            $telefono,
            $celular,
            $correo,
            $usuario,
            $clave,
            $sueldo,
            $fechaingreso,
            $especialidad,
            $estado,
            $codigodistrito,
            $codigosexo,
            $codigorol,
            $codigotipodocumento,
            $codigoestadocivil,
            $codigogradoinstruccion
        );

        return $stmt->execute();
    }

    // Buscar cliente por código
    public function findById($id)
    {
        $sql = "SELECT
                    e.codemp, e.nomemp, e.apepemp, e.apememp, e.docemp, e.fecemp, e.diremp,
                    e.telemp, e.celemp, e.coremp, e.usuemp, e.claemp, e.sueemp, e.fecing, e.nomesp, e.estemp, e.coddis, e.codsex, e.codrol, e.codtipd, e.codestc, e.codgrai,
                    d.nomdis, s.nomsex, r.nomrol, t.nomtipd, ec.nomestc, g.nomgrai
                FROM empleado e
                INNER JOIN distrito d ON e.coddis = d.coddis
                INNER JOIN sexo s ON e.codsex = s.codsex
                INNER JOIN rol r ON e.codrol = r.codrol
                INNER JOIN tipodocumento t ON e.codtipd = t.codtipd
                INNER JOIN estadocivil ec ON e.codestc = ec.codestc
                INNER JOIN gradoinstruccion g ON e.codgrai = g.codgrai
                WHERE e.codemp = ?";

        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        return $stmt->get_result();
    }

    // Actualizar cliente
    public function update($id, $nombre, $apellidopaterno, $apellidomaterno, $documento, $fecha, $direccion, $telefono, $celular, $correo, $usuario, $clave, $sueldo, $fechaingreso, $especialidad, $estado,        $codigodistrito, $codigosexo, $codigorol, $codigotipodocumento, $codigoestadocivil, $codigogradoinstruccion)
    {
        $sql = "UPDATE empleado SET
                    nomemp = ?, apepemp = ?, apememp = ?, docemp = ?, fecemp = ?, diremp = ?, telemp = ?, celemp = ?,coremp = ?, usuemp = ?, claemp = ?, sueemp = ?, fecing = ?, nomesp = ?,
                    estemp = ?, coddis = ?, codsex = ?, codrol = ?, codtipd = ?, codestc = ?, codgrai = ?
                WHERE codemp = ?";

        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param(
            'sssssssssssdssiiiiiiii',
            $nombre,
            $apellidopaterno,
            $apellidomaterno,
            $documento,
            $fecha,
            $direccion,
            $telefono,
            $celular,
            $correo,
            $usuario,
            $clave,
            $sueldo,
            $fechaingreso,
            $especialidad,
            $estado,
            $codigodistrito,
            $codigosexo,
            $codigorol,
            $codigotipodocumento,
            $codigoestadocivil,
            $codigogradoinstruccion,
            $id
        );

        return $stmt->execute();
    }

    // Eliminación lógica
    public function delete($id)
    {
        return $this->disable($id);
    }

    // Habilitar cliente
    public function enable($id)
    {
        $sql = "UPDATE empleado SET estemp = 1 WHERE codemp = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);

        return $stmt->execute();
    }

    // Deshabilitar cliente
    public function disable($id)
    {
        $sql = "UPDATE empleado SET estemp = 0 WHERE codemp = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);

        return $stmt->execute();
    }
    
    public function login($usuario, $clave)
    {
        $sql = "SELECT
                e.codemp, e.nomemp, e.apepemp, e.apememp, e.usuemp,
                e.codrol, r.nomrol
            FROM empleado e
            INNER JOIN rol r ON e.codrol = r.codrol
            WHERE e.usuemp = ? AND e.claemp = ? AND e.estemp = 1";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('ss', $usuario, $clave);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

}

?>