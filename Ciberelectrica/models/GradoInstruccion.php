<?php
require_once '../config/database.php';

class GradoInstruccion
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
        $sql = "SELECT * FROM gradoinstruccion WHERE estgrai = 1 LIMIT ?, ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('ii', $inicio, $limite);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Contar distritos habilitados
    public function countAllCustom()
    {
        $sql = "SELECT COUNT(*) AS total FROM gradoinstruccion WHERE estgrai = 1";
        $resultado = $this->xcon->query($sql);
        $fila = $resultado->fetch_assoc();
        return $fila['total'];
    }

    // Listar todos con paginación
    public function findAllPaginated($inicio, $limite)
    {
        $sql = "SELECT * FROM gradoinstruccion LIMIT ?, ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('ii', $inicio, $limite);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Contar todos los distritos
    public function countAll()
    {
        $sql = "SELECT COUNT(*) AS total FROM gradoinstruccion";
        $resultado = $this->xcon->query($sql);
        $fila = $resultado->fetch_assoc();
        return $fila['total'];
    }

    public function findAllCustom()
    {
        $sql = "SELECT
        g.codgrai,
        g.nomgrai,
        g.estgrai
        FROM gradoinstruccion g
        WHERE g.estgrai = 1
        ORDER BY g.nomgrai ASC";
        return $this -> xcon -> query($sql);
    }

    public function findAll()
    {
        $sql = "SELECT
        g.codgrai,
        g.nomgrai,
        g.estgrai
        FROM gradoinstruccion g
        ORDER BY g.codgrai DESC";
        return $this -> xcon -> query($sql);
    }


    // Agregar distrito
    public function add($nombre, $estado)
    {
        $sql = "INSERT INTO gradoinstruccion (nomgrai, estgrai) VALUES (?, ?)";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('si', $nombre, $estado);
        return $stmt->execute();
    }

    // Buscar Distrito por ID
    public function findById($id)
    {
        $sql = "SELECT * FROM gradoinstruccion WHERE codgrai = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Actualizar distrito
    public function update($id, $nombre, $estado)
    {
        $sql = "UPDATE gradoinstruccion SET nomgrai = ?, estgrai = ? WHERE codgrai = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('sii', $nombre, $estado, $id);
        return $stmt->execute();
    }

    // Eliminar lógico (deshabilitar)
    public function delete($id)
    {
        $sql = "UPDATE gradoinstruccion SET estgrai = 0 WHERE codgrai = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    // Habilitar distrito
    public function enable($id)
    {
        $sql = "UPDATE gradoinstruccion SET estgrai = 1 WHERE codgrai = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    // Deshabilitar distrito
    public function disable($id)
    {
        $sql = "UPDATE gradoinstruccion SET estgrai = 0 WHERE codgrai = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}
?>