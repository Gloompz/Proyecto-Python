<?php
require_once '../config/database.php';

class Distrito
{
    private $xcon;

    public function __construct()
    {
        $db = new Conexion();
        $this->xcon = $db->Conectar();
    }

    // Listar habilitados con paginación
    public function findAllCustomPaginated($inicio, $limite)
    {
        $sql = "SELECT * FROM distrito WHERE estdis = 1 LIMIT ?, ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('ii', $inicio, $limite);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Contar distritos habilitados
    public function countAllCustom()
    {
        $sql = "SELECT COUNT(*) AS total FROM distrito WHERE estdis = 1";
        $resultado = $this->xcon->query($sql);
        $fila = $resultado->fetch_assoc();
        return $fila['total'];
    }

    // Listar todos con paginación
    public function findAllPaginated($inicio, $limite)
    {
        $sql = "SELECT * FROM distrito LIMIT ?, ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('ii', $inicio, $limite);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Contar todos los distritos
    public function countAll()
    {
        $sql = "SELECT COUNT(*) AS total FROM distrito";
        $resultado = $this->xcon->query($sql);
        $fila = $resultado->fetch_assoc();
        return $fila['total'];
    }

    public function findAllCustom()
    {
        $sql = "SELECT
        d.coddis,
        d.nomdis,
        d.estdis
        FROM distrito d
        WHERE d.estdis = 1
        ORDER BY d.nomdis ASC";
        return $this->xcon->query($sql);
    }

    public function findAll()
    {
        $sql = "SELECT
        d.coddis,
        d.nomdis,
        d.estdis
        FROM distrito d
        ORDER BY d.coddis DESC";
        return $this->xcon->query($sql);
    }



    // Agregar distrito
    public function add($nombre, $estado)
    {
        $sql = "INSERT INTO distrito (nomdis, estdis) VALUES (?, ?)";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('si', $nombre, $estado);
        return $stmt->execute();
    }

    // Buscar Distrito por ID
    public function findById($id)
    {
        $sql = "SELECT * FROM distrito WHERE coddis = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Actualizar distrito
    public function update($id, $nombre, $estado)
    {
        $sql = "UPDATE distrito SET nomdis = ?, estdis = ? WHERE coddis = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('sii', $nombre, $estado, $id);
        return $stmt->execute();
    }

    // Eliminar lógico (deshabilitar)
    public function delete($id)
    {
        $sql = "UPDATE distrito SET estdis = 0 WHERE coddis = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    // Habilitar distrito
    public function enable($id)
    {
        $sql = "UPDATE distrito SET estdis = 1 WHERE coddis = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    // Deshabilitar distrito
    public function disable($id)
    {
        $sql = "UPDATE distrito SET estdis = 0 WHERE coddis = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
?>