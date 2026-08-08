<?php
require_once '../config/database.php';

class EstadoCivil
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
        $sql = "SELECT * FROM estadocivil WHERE estestc = 1 LIMIT ?, ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('ii', $inicio, $limite);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Contar distritos habilitados
    public function countAllCustom()
    {
        $sql = "SELECT COUNT(*) AS total FROM estadocivil WHERE estestc = 1";
        $resultado = $this->xcon->query($sql);
        $fila = $resultado->fetch_assoc();
        return $fila['total'];
    }

    // Listar todos con paginación
    public function findAllPaginated($inicio, $limite)
    {
        $sql = "SELECT * FROM estadocivil LIMIT ?, ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('ii', $inicio, $limite);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Contar todos los distritos
    public function countAll()
    {
        $sql = "SELECT COUNT(*) AS total FROM estadocivil";
        $resultado = $this->xcon->query($sql);
        $fila = $resultado->fetch_assoc();
        return $fila['total'];
    }

    public function findAllCustom()
    {
        $sql = "SELECT
        e.codestc,
        e.nomestc,
        e.estestc
        FROM estadocivil e
        WHERE e.estestc = 1
        ORDER BY e.nomestc ASC";
        return $this -> xcon -> query($sql);
    }

    public function findAll()
    {
        $sql = "SELECT
        e.codestc,
        e.nomestc,
        e.estestc
        FROM estadocivil e
        ORDER BY e.codestc DESC";
        return $this -> xcon -> query($sql);
    }

    // Agregar distrito
    public function add($nombre, $estado)
    {
        $sql = "INSERT INTO estadocivil (nomestc, estestc) VALUES (?, ?)";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('si', $nombre, $estado);
        return $stmt->execute();
    }

    // Buscar Distrito por ID
    public function findById($id)
    {
        $sql = "SELECT * FROM estadocivil WHERE codestc = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Actualizar distrito
    public function update($id, $nombre, $estado)
    {
        $sql = "UPDATE estadocivil SET nomestc = ?, estestc = ? WHERE codestc = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('sii', $nombre, $estado, $id);
        return $stmt->execute();
    }

    // Eliminar lógico (deshabilitar)
    public function delete($id)
    {
        $sql = "UPDATE estadocivil SET estestc = 0 WHERE codestc = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    // Habilitar distrito
    public function enable($id)
    {
        $sql = "UPDATE estadocivil SET estestc = 1 WHERE codestc = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    // Deshabilitar distrito
    public function disable($id)
    {
        $sql = "UPDATE estadocivil SET estestc = 0 WHERE codestc = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
?>