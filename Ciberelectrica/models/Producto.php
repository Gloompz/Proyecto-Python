<?php

require_once '../config/database.php';

class Producto
{
    private $xcon;

    public function __construct()
    {
        $db = new Conexion();
        $this->xcon = $db->Conectar();
    }

    // Listar productos habilitados con marca y categoría (paginación)
    public function findAllCustomPaginated($inicio, $limite)
    {
        $sql = "SELECT
                    p.codpro, p.nompro, p.despro, p.fecing, p.prepro, p.canpro, p.estpro,
                    p.codmar, p.codcat, m.nommar, c.nomcat
                FROM producto p
                INNER JOIN marca m ON p.codmar = m.codmar
                INNER JOIN categoria c ON p.codcat = c.codcat
                WHERE p.estpro = 1
                ORDER BY p.codpro ASC
                LIMIT ?, ?";

        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('ii', $inicio, $limite);
        $stmt->execute();

        return $stmt->get_result();
    }

    // Contar productos habilitados
    public function countAllCustom()
    {
        $sql = "SELECT COUNT(*) AS total FROM producto WHERE estpro = 1";
        $resultado = $this->xcon->query($sql);
        $fila = $resultado->fetch_assoc();

        return $fila['total'];
    }

    // Listar todos los productos con paginación
    public function findAllPaginated($inicio, $limite)
    {
        $sql = "SELECT
                    p.codpro, p.nompro, p.despro, p.fecing, p.prepro, p.canpro, p.estpro,
                    p.codmar, p.codcat, m.nommar, c.nomcat
                FROM producto p
                INNER JOIN marca m ON p.codmar = m.codmar
                INNER JOIN categoria c ON p.codcat = c.codcat
                ORDER BY p.codpro ASC
                LIMIT ?, ?";

        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('ii', $inicio, $limite);
        $stmt->execute();

        return $stmt->get_result();
    }

    // Contar todos los productos
    public function countAll()
    {
        $sql = "SELECT COUNT(*) AS total FROM producto";
        $resultado = $this->xcon->query($sql);
        $fila = $resultado->fetch_assoc();

        return $fila['total'];
    }

    // Listar productos habilitados (sin paginación)
    public function findAllCustom()
    {
        $sql = "SELECT
                    p.codpro, p.nompro, p.despro, p.fecing, p.prepro, p.canpro, p.estpro,
                    p.codmar, p.codcat, m.nommar, c.nomcat
                FROM producto p
                INNER JOIN marca m ON p.codmar = m.codmar
                INNER JOIN categoria c ON p.codcat = c.codcat
                WHERE p.estpro = 1
                ORDER BY p.nompro ASC";

        return $this->xcon->query($sql);
    }

    // Listar todos los productos (sin paginación)
    public function findAll()
    {
        $sql = "SELECT
                    p.codpro, p.nompro, p.despro, p.fecing, p.prepro, p.canpro, p.estpro,
                    p.codmar, p.codcat, m.nommar, c.nomcat
                FROM producto p
                INNER JOIN marca m ON p.codmar = m.codmar
                INNER JOIN categoria c ON p.codcat = c.codcat
                ORDER BY p.codpro DESC";

        return $this->xcon->query($sql);
    }

    // Registrar producto
    public function add($nombre, $descripcion, $fechaIngreso, $precio, $cantidad, $estado, $codigoMarca, $codigoCategoria)
    {
        $sql = "INSERT INTO producto
                (nompro, despro, fecing, prepro, canpro, estpro, codmar, codcat)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param(
            'sssdiiii',
            $nombre,
            $descripcion,
            $fechaIngreso,
            $precio,
            $cantidad,
            $estado,
            $codigoMarca,
            $codigoCategoria
        );

        return $stmt->execute();
    }

    // Buscar producto por código
    public function findById($id)
    {
        $sql = "SELECT
                    p.codpro, p.nompro, p.despro, p.fecing, p.prepro, p.canpro, p.estpro,
                    p.codmar, p.codcat, m.nommar, c.nomcat
                FROM producto p
                INNER JOIN marca m ON p.codmar = m.codmar
                INNER JOIN categoria c ON p.codcat = c.codcat
                WHERE p.codpro = ?";

        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        return $stmt->get_result();
    }

    // Actualizar producto
    public function update($id, $nombre, $descripcion, $fechaIngreso, $precio, $cantidad, $estado, $codigoMarca, $codigoCategoria)
    {
        $sql = "UPDATE producto SET
                    nompro = ?, despro = ?, fecing = ?, prepro = ?, canpro = ?, estpro = ?, codmar = ?, codcat = ?
                WHERE codpro = ?";

        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param(
            'sssdiiiii',
            $nombre,
            $descripcion,
            $fechaIngreso,
            $precio,
            $cantidad,
            $estado,
            $codigoMarca,
            $codigoCategoria,
            $id
        );

        return $stmt->execute();
    }

    // Eliminación lógica
    public function delete($id)
    {
        return $this->disable($id);
    }

    // Habilitar producto
    public function enable($id)
    {
        $sql = "UPDATE producto SET estpro = 1 WHERE codpro = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);

        return $stmt->execute();
    }

    // Deshabilitar producto
    public function disable($id)
    {
        $sql = "UPDATE producto SET estpro = 0 WHERE codpro = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);

        return $stmt->execute();
    }
}
?>