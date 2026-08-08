<?php
require_once '../config/database.php';

class TicketPedido
{
    private $xcon;

    public function __construct()
    {
        $db = new Conexion();
        $this->xcon = $db->Conectar();
    }

    // Listar tickets con cliente y empleado
    public function findAllPaginated($inicio, $limite)
    {
        $sql = "SELECT t.nrotic, t.fectic, t.esttic,
                    c.nomcli, c.apepcli, c.apemcli, c.doccli,
                    e.nomemp, e.apepemp, e.apememp, e.docemp,
                    SUM(d.cantic * d.pretic) AS subtotal
                FROM ticketpedido t
                INNER JOIN cliente c ON t.codcli = c.codcli
                INNER JOIN empleado e ON t.codemp = e.codemp
                INNER JOIN detalleticketpedido d ON t.nrotic = d.nrotic
                GROUP BY t.nrotic
                ORDER BY t.nrotic ASC
                LIMIT ?, ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('ii', $inicio, $limite);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function countAll()
    {
        $sql = "SELECT COUNT(*) AS total FROM ticketpedido";
        $resultado = $this->xcon->query($sql);
        $fila = $resultado->fetch_assoc();
        return $fila['total'];
    }

    // Cabecera del ticket
    public function findCabeceraByTicket($nrotic)
    {
        $sql = "SELECT t.nrotic, t.fectic, t.esttic,
                    c.nomcli, c.apepcli, c.apemcli, c.doccli, c.dircli, c.celcli,
                    e.nomemp, e.apepemp, e.apememp, e.docemp, e.diremp, e.telemp
                FROM ticketpedido t
                INNER JOIN cliente c ON t.codcli = c.codcli
                INNER JOIN empleado e ON t.codemp = e.codemp
                WHERE t.nrotic = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $nrotic);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Detalle del ticket
    public function findDetalleByTicket($nrotic)
    {
        $sql = "SELECT d.nrodettic, p.nompro, d.cantic, d.pretic, (d.cantic * d.pretic) AS total
                FROM detalleticketpedido d
                INNER JOIN producto p ON d.codpro = p.codpro
                WHERE d.nrotic = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $nrotic);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function anular($id)
    {
        $sql = "UPDATE ticketpedido SET esttic = 0 WHERE nrotic = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public function habilitar($id)
    {
        $sql = "UPDATE ticketpedido SET esttic = 1 WHERE nrotic = ?";
        $stmt = $this->xcon->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public function getNextNumber()
    {
        $sql = "SELECT IFNULL(MAX(nrotic), 0) + 1 AS siguiente FROM ticketpedido";
        $resultado = $this->xcon->query($sql);
        $fila = $resultado->fetch_assoc();
        return $fila['siguiente'];
    }

    public function registrar($estado, $codcli, $codemp, $productos)
    {
        try {
            $this->xcon->begin_transaction();

            // Insertar cabecera con NOW()
            $sqlCab = "INSERT INTO ticketpedido (fectic, esttic, codcli, codemp) VALUES (NOW(), ?, ?, ?)";
            $stmtCab = $this->xcon->prepare($sqlCab);
            $stmtCab->bind_param('iii', $estado, $codcli, $codemp);
            $stmtCab->execute();
            $nrotic = $this->xcon->insert_id; // correlativo generado

            // Insertar detalle
            $sqlDet = "INSERT INTO detalleticketpedido (nrotic, codpro, cantic, pretic) VALUES (?, ?, ?, ?)";
            $stmtDet = $this->xcon->prepare($sqlDet);

            foreach ($productos as $prod) {
                $stmtDet->bind_param(
                    'iiid',
                    $nrotic,
                    $prod['codpro'],
                    $prod['cantidad'],
                    $prod['precio']
                );
                $stmtDet->execute();
            }

            $this->xcon->commit();
            return true;
        } catch (Exception $e) {
            $this->xcon->rollback();
            throw $e;
        }
    }
}
?>