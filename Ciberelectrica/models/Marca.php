<?php

require_once '../config/database.php';

class Marca
{
    private $xcon;

    public function __construct()
    {
        $db = new Conexion();
        $this->xcon = $db->Conectar();
    }

    // Listar marcas habilitadas con paginación - ORDENADO POR CÓDIGO
    public function findAllCustomPaginated($inicio, $limite)
    {
        $sql = "SELECT * FROM marca
            WHERE estmar = 1
            ORDER BY codmar ASC  
            LIMIT ?, ?";

    $stmt = $this->xcon->prepare($sql);
    $stmt->bind_param('ii', $inicio, $limite);
    $stmt->execute();

    return $stmt->get_result();
    }
    // Contar marcas habilitadas
    public function countAllCustom()
    {
        $sql = "SELECT COUNT(*) AS total FROM marca WHERE estmar = 1";
        $resultado = $this->xcon->query($sql);
        $fila = $resultado->fetch_assoc();

        return $fila['total'];
    }

    // Listar todas las marcas con paginación
    public function findAllPaginated($inicio, $limite)
    {
        $sql = "SELECT * FROM marca
                ORDER BY codmar ASC
                LIMIT ?, ?";

        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('ii', $inicio, $limite);
        $stmt->execute();

        return $stmt->get_result();
    }

    // Contar todas las marcas
    public function countAll()
    {
        $sql = "SELECT COUNT(*) AS total FROM marca";
        $resultado = $this->xcon->query($sql);
        $fila = $resultado->fetch_assoc();

        return $fila['total'];
    }

    // Listar habilitadas (sin paginación)
    public function findAllCustom()
    {
        $sql = "SELECT * FROM marca WHERE estmar = 1 ORDER BY nommar ASC";
        return $this->xcon->query($sql);
    }

    // Listar todas (sin paginación)
    public function findAll()
    {
        $sql = "SELECT * FROM marca ORDER BY codmar DESC";
        return $this->xcon->query($sql);
    }

    // Registrar marca
    public function add($nombre, $estado)
    {
        $sql = "INSERT INTO marca (nommar, estmar) VALUES (?, ?)";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('si', $nombre, $estado);

        return $stmt->execute();
    }

    // Buscar por código
    public function findById($id)
    {
        $sql = "SELECT * FROM marca WHERE codmar = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        return $stmt->get_result();
    }

    // Actualizar marca
    public function update($id, $nombre, $estado)
    {
        $sql = "UPDATE marca SET nommar = ?, estmar = ? WHERE codmar = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('sii', $nombre, $estado, $id);

        return $stmt->execute();
    }

    // Eliminación lógica
    public function delete($id)
    {
        return $this->disable($id);
    }

    // Habilitar
    public function enable($id)
    {
        $sql = "UPDATE marca SET estmar = 1 WHERE codmar = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);

        return $stmt->execute();
    }

    // Deshabilitar
    public function disable($id)
    {
        $sql = "UPDATE marca SET estmar = 0 WHERE codmar = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);

        return $stmt->execute();
    }
}

?>