<?php

require_once '../config/database.php';

class Cliente
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
                    c.codcli, c.nomcli, c.apepcli, c.apemcli, c.doccli, c.feccli, c.dircli,
                    c.telcli, c.celcli, c.corcli, c.estcli, c.coddis, c.codsex, c.codtipd, 
                    d.nomdis, s.nomsex, t.nomtipd
                FROM cliente c
                INNER JOIN distrito d ON c.coddis = d.coddis
                INNER JOIN sexo s ON c.codsex = s.codsex
                INNER JOIN tipodocumento t ON c.codtipd = t.codtipd
                WHERE c.estcli = 1
                ORDER BY c.codcli ASC
                LIMIT ?, ?";

        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('ii', $inicio, $limite);
        $stmt->execute();

        return $stmt->get_result();
    }

    public function countCustom()
    {
        $sql = "SELECT COUNT(*) AS total
            FROM cliente
            WHERE estcli = 1";

    $resultado = $this->xcon->query($sql);
    $fila = $resultado->fetch_assoc();

    return $fila['total'];
    }

    // Contar clientes habilitados
    public function countAllCustom()
    {
        $sql = "SELECT COUNT(*) AS total FROM cliente WHERE estcli = 1";
        $resultado = $this->xcon->query($sql);
        $fila = $resultado->fetch_assoc();

        return $fila['total'];
    }

    public function buscarPorNombre($termino)
        {
            $sql = "SELECT codcli, nomcli, apepcli, apemcli, doccli, celcli 
                    FROM cliente 
                    WHERE (nomcli LIKE ? OR apepcli LIKE ? OR doccli LIKE ?) 
                    AND estcli = 1";
            $stmt = $this->xcon->prepare($sql);
            $like = "%$termino%";
            $stmt->bind_param('sss', $like, $like, $like);
            $stmt->execute();
            return $stmt->get_result();
        }

    // Listar todos los clientes con paginación
    public function findAllPaginated($inicio, $limite)
    {
        $sql = "SELECT
                    c.codcli, c.nomcli, c.apepcli, c.apemcli, c.doccli, c.feccli, c.dircli,
                    c.telcli, c.celcli, c.corcli, c.estcli, c.coddis, c.codsex, c.codtipd, 
                    d.nomdis, s.nomsex, t.nomtipd
                FROM cliente c
                INNER JOIN distrito d ON c.coddis = d.coddis
                INNER JOIN sexo s ON c.codsex = s.codsex
                INNER JOIN tipodocumento t ON c.codtipd = t.codtipd
                ORDER BY c.codcli ASC
                LIMIT ?, ?";

        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('ii', $inicio, $limite);
        $stmt->execute();

        return $stmt->get_result();
    }

    // Contar todos los clientes
    public function countAll()
    {
        $sql = "SELECT COUNT(*) AS total FROM cliente";
        $resultado = $this->xcon->query($sql);
        $fila = $resultado->fetch_assoc();

        return $fila['total'];
    }

    // Listar clientes habilitados (sin paginación)
    public function findAllCustom()
    {
        $sql = "SELECT
                    c.codcli, c.nomcli, c.apepcli, c.apemcli, c.doccli, c.feccli, c.dircli,
                    c.telcli, c.celcli, c.corcli, c.estcli, c.coddis, c.codsex, c.codtipd, 
                    d.nomdis, s.nomsex, t.nomtipd
                FROM cliente c
                INNER JOIN distrito d ON c.coddis = d.coddis
                INNER JOIN sexo s ON c.codsex = s.codsex
                INNER JOIN tipodocumento t ON c.codtipd = t.codtipd
                WHERE c.estcli = 1
                ORDER BY c.nomcli ASC";

        return $this->xcon->query($sql);
    }

    // Listar todos los clientes (sin paginación)
    public function findAll()
    {
        $sql = "SELECT
                    c.codcli, c.nomcli, c.apepcli, c.apemcli, c.doccli, c.feccli, c.dircli,
                    c.telcli, c.celcli, c.corcli, c.estcli, c.coddis, c.codsex, c.codtipd, 
                    d.nomdis, s.nomsex, t.nomtipd
                FROM cliente c
                INNER JOIN distrito d ON c.coddis = d.coddis
                INNER JOIN sexo s ON c.codsex = s.codsex
                INNER JOIN tipodocumento t ON c.codtipd = t.codtipd
                ORDER BY c.codcli DESC";

        return $this->xcon->query($sql);
    }

    // Registrar cliente
    public function add($nombre, $apellidopaterno, $apellidomaterno, $documento, $fecha, $direccion, $telefono, $celular, $correo, $estado, $codigodistrito, $codigosexo, $codigotipodocumento)
    {
        $sql = "INSERT INTO cliente
                (nomcli, apepcli, apemcli, doccli, feccli, dircli, telcli, celcli, corcli, estcli, coddis, codsex, codtipd)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param(
            'sssssssssisii',
            $nombre,
            $apellidopaterno,
            $apellidomaterno,
            $documento,
            $fecha,
            $direccion,
            $telefono,
            $celular,
            $correo,
            $estado,
            $codigodistrito,
            $codigosexo,
            $codigotipodocumento
        );

        return $stmt->execute();
    }

    // Buscar cliente por código
    public function findById($id)
    {
        $sql = "SELECT
                    c.codcli, c.nomcli, c.apepcli, c.apemcli, c.doccli, c.feccli, c.dircli,
                    c.telcli, c.celcli, c.corcli, c.estcli, c.coddis, c.codsex, c.codtipd, 
                    d.nomdis, s.nomsex, t.nomtipd
                FROM cliente c
                INNER JOIN distrito d ON c.coddis = d.coddis
                INNER JOIN sexo s ON c.codsex = s.codsex
                INNER JOIN tipodocumento t ON c.codtipd = t.codtipd
                WHERE c.codcli = ?";

        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        return $stmt->get_result();
    }

    // Actualizar cliente
    public function update($id, $nombre, $apellidopaterno, $apellidomaterno, $documento, $fecha, $direccion, $telefono, $celular, $correo, $estado, $codigodistrito, $codigosexo, $codigotipodocumento)
    {
        $sql = "UPDATE cliente SET
                    nomcli = ?, apepcli = ?, apemcli = ?, doccli = ?, feccli = ?, 
                    dircli = ?, telcli = ?, celcli = ?, corcli = ?, estcli = ?, 
                    coddis = ?, codsex = ?, codtipd = ?
                WHERE codcli = ?";

        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param(
            'sssssssssisiii',
            $nombre,
            $apellidopaterno,
            $apellidomaterno,
            $documento,
            $fecha,
            $direccion,
            $telefono,
            $celular,
            $correo,
            $estado,
            $codigodistrito,
            $codigosexo,
            $codigotipodocumento,
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
        $sql = "UPDATE cliente SET estcli = 1 WHERE codcli = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);

        return $stmt->execute();
    }

    // Deshabilitar cliente
    public function disable($id)
    {
        $sql = "UPDATE cliente SET estcli = 0 WHERE codcli = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);

        return $stmt->execute();
    }
}

?>