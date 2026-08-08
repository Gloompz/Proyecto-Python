<?php
require_once '../config/database.php';

class TipoDocumento
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
        $sql = "SELECT * FROM tipodocumento WHERE esttipd = 1 LIMIT ?, ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('ii', $inicio, $limite);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Contar distritos habilitados
    public function countAllCustom()
    {
        $sql = "SELECT COUNT(*) AS total FROM tipodocumento WHERE esttipd = 1";
        $resultado = $this->xcon->query($sql);
        $fila = $resultado->fetch_assoc();
        return $fila['total'];
    }

    // Listar todos con paginación
    public function findAllPaginated($inicio, $limite)
    {
        $sql = "SELECT * FROM tipodocumento LIMIT ?, ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('ii', $inicio, $limite);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Contar todos los distritos
    public function countAll()
    {
        $sql = "SELECT COUNT(*) AS total FROM tipodocumento";
        $resultado = $this->xcon->query($sql);
        $fila = $resultado->fetch_assoc();
        return $fila['total'];
    }

    public function findAllCustom()
    {
        $sql = "SELECT
        t.codtipd,
        t.nomtipd,
        t.esttipd
        FROM tipodocumento t
        WHERE t.esttipd = 1
        ORDER BY t.nomtipd ASC";
        return $this -> xcon -> query($sql);
    }

    public function findAll()
    {
        $sql = "SELECT
        t.codtipd,
        t.nomtipd,
        t.esttipd
        FROM tipodocumento t
        ORDER BY t.codtipd DESC";
        return $this -> xcon -> query($sql);
    }

    // Agregar distrito
    public function add($nombre, $estado)
    {
        $sql = "INSERT INTO tipodocumento (nomtipd, esttipd) VALUES (?, ?)";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('si', $nombre, $estado);
        return $stmt->execute();
    }

    // Buscar Distrito por ID
    public function findById($id)
    {
        $sql = "SELECT * FROM tipodocumento WHERE codtipd = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Actualizar distrito
    public function update($id, $nombre, $estado)
    {
        $sql = "UPDATE tipodocumento SET nomtipd = ?, esttipd = ? WHERE codtipd = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('sii', $nombre, $estado, $id);
        return $stmt->execute();
    }

    // Eliminar lógico (deshabilitar)
    public function delete($id)
    {
        $sql = "UPDATE tipodocumento SET esttipd = 0 WHERE codtipd = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    // Habilitar distrito
    public function enable($id)
    {
        $sql = "UPDATE tipodocumento SET esttipd = 1 WHERE codtipd = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    // Deshabilitar distrito
    public function disable($id)
    {
        $sql = "UPDATE tipodocumento SET esttipd = 0 WHERE codtipd = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
?>