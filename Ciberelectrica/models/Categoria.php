<?php

require_once '../config/database.php';

class Categoria
{
    private $xcon;

    public function __construct()
    {
        $db = new Conexion();
        $this->xcon = $db->Conectar();
    }

    // Listar categorías habilitadas con paginación
    public function findAllCustomPaginated($inicio, $limite)
    {
    $sql = "SELECT * FROM categoria
            WHERE estcat = 1
            ORDER BY codcat ASC   
            LIMIT ?, ?";

    $stmt = $this->xcon->prepare($sql);
    $stmt->bind_param('ii', $inicio, $limite);
    $stmt->execute();

    return $stmt->get_result();
    }

    //Contar categorías habilitadas
    public function countAllCustom()
    {
        $sql = "SELECT COUNT(*) AS total FROM categoria WHERE estcat = 1";
        $resultado = $this->xcon->query($sql);
        $fila = $resultado->fetch_assoc();

        return $fila['total'];
    }

    // Listar todas las categorías con paginación
    public function findAllPaginated($inicio, $limite)
    {
        $sql = "SELECT * FROM categoria
                ORDER BY codcat ASC
                LIMIT ?, ?";

        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('ii', $inicio, $limite);
        $stmt->execute();

        return $stmt->get_result();
    }

    // Contar todas las categorías
    public function countAll()
    {
        $sql = "SELECT COUNT(*) AS total FROM categoria";
        $resultado = $this->xcon->query($sql);
        $fila = $resultado->fetch_assoc();

        return $fila['total'];
    }

    // Listar habilitadas (sin paginación)
    public function findAllCustom()
    {
        $sql = "SELECT * FROM categoria WHERE estcat = 1 ORDER BY nomcat ASC";
        return $this->xcon->query($sql);
    }

    // Listar todas (sin paginación)
    public function findAll()
    {
        $sql = "SELECT * FROM categoria ORDER BY codcat ASC";
        return $this->xcon->query($sql);
    }

    // Registrar categoría
    public function add($nombre, $estado)
    {
        $sql = "INSERT INTO categoria (nomcat, estcat) VALUES (?, ?)";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('si', $nombre, $estado);

        return $stmt->execute();
    }

    // Buscar por código
    public function findById($id)
    {
        $sql = "SELECT * FROM categoria WHERE codcat = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        return $stmt->get_result();
    }

    // Actualizar categoría
    public function update($id, $nombre, $estado)
    {
        $sql = "UPDATE categoria SET nomcat = ?, estcat = ? WHERE codcat = ?";
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
        $sql = "UPDATE categoria SET estcat = 1 WHERE codcat = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);

        return $stmt->execute();
    }

    // Deshabilitar
    public function disable($id)
    {
        $sql = "UPDATE categoria SET estcat = 0 WHERE codcat = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);

        return $stmt->execute();
    }
}

?>