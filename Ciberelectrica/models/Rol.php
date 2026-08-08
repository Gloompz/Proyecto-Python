<?php
require_once '../config/database.php';

class Rol
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
        $sql = "SELECT * FROM rol WHERE estrol = 1 LIMIT ?, ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('ii', $inicio, $limite);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Contar distritos habilitados
    public function countAllCustom()
    {
        $sql = "SELECT COUNT(*) AS total FROM rol WHERE estrol = 1";
        $resultado = $this->xcon->query($sql);
        $fila = $resultado->fetch_assoc();
        return $fila['total'];
    }

    // Listar todos con paginación
    public function findAllPaginated($inicio, $limite)
    {
        $sql = "SELECT * FROM rol LIMIT ?, ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('ii', $inicio, $limite);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Contar todos los distritos
    public function countAll()
    {
        $sql = "SELECT COUNT(*) AS total FROM rol";
        $resultado = $this->xcon->query($sql);
        $fila = $resultado->fetch_assoc();
        return $fila['total'];
    }

    public function findAllCustom()
    {
        $sql = "SELECT
        r.codrol,
        r.nomrol,
        r.estrol
        FROM rol r
        WHERE r.estrol = 1
        ORDER BY r.nomrol ASC";
        return $this -> xcon -> query($sql);
    }

    public function findAll()
    {
        $sql = "SELECT
        r.codrol,
        r.nomrol,
        r.estrol
        FROM rol r
        ORDER BY r.codrol DESC";
        return $this -> xcon -> query($sql);
    }

    // Agregar distrito
    public function add($nombre, $estado)
    {
        $sql = "INSERT INTO rol (nomrol, estrol) VALUES (?, ?)";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('si', $nombre, $estado);
        return $stmt->execute();
    }

    // Buscar Distrito por ID
    public function findById($id)
    {
        $sql = "SELECT * FROM rol WHERE codrol = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Actualizar distrito
    public function update($id, $nombre, $estado)
    {
        $sql = "UPDATE rol SET nomrol = ?, estrol = ? WHERE codrol = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('sii', $nombre, $estado, $id);
        return $stmt->execute();
    }

    // Eliminar lógico (deshabilitar)
    public function delete($id)
    {
        $sql = "UPDATE rol SET estrol = 0 WHERE codrol = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    // Habilitar distrito
    public function enable($id)
    {
        $sql = "UPDATE rol SET estrol = 1 WHERE codrol = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    // Deshabilitar distrito
    public function disable($id)
    {
        $sql = "UPDATE rol SET esttipd = 0 WHERE codrol = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
?>