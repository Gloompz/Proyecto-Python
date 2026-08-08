<?php
require_once __DIR__ . '/../models/Cliente.php';
require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/TicketPedido.php';

class TicketPedidoController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new TicketPedido();
    }

    public function listar()
    {
        $limite = 5;
        $pagina = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        if ($pagina < 1) $pagina = 1;
        $inicio = ($pagina - 1) * $limite;
        $totalRegistros = $this->modelo->countAll();
        $totalPaginas = ceil($totalRegistros / $limite);
        $tickets = $this->modelo->findAllPaginated($inicio, $limite);
        require_once __DIR__ . '/../views/ticketpedido/listarticket.php';
    }

    public function detalle()
    {
        $id = $_GET['id'] ?? 0;
        $cabecera = $this->modelo->findCabeceraByTicket($id);
        $detalle = $this->modelo->findDetalleByTicket($id);
        require_once __DIR__ . '/../views/ticketpedido/detalleticket.php';
    }

    public function anular()
    {
        $id = $_GET['id'] ?? 0;
        $this->modelo->anular($id);
        header('Location: /ciberelectrica/public/?controller=ticketpedido&action=listar');
        exit;
    }

    public function habilitar()
    {
        $id = $_GET['id'] ?? 0;
        $this->modelo->habilitar($id);
        header('Location: /ciberelectrica/public/?controller=ticketpedido&action=listar');
        exit;
    }

    public function registro()
    {
        $limite = 5;
        $pagina = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        if ($pagina < 1) $pagina = 1;
        $inicio = ($pagina - 1) * $limite;
        $modeloCliente = new Cliente();
        $totalRegistros = $modeloCliente->countCustom();
        $totalPaginas = ceil($totalRegistros / $limite);
        $clientes = $modeloCliente->findAllCustom($inicio, $limite);
        $modeloProducto = new Producto();
        $productos = $modeloProducto->findAllCustom();
        $modeloTicket = new TicketPedido();
        $numeroTicket = $modeloTicket->getNextNumber();
        require_once __DIR__ . '/../views/ticketpedido/registrarticket.php';
    }

    public function registrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $estado = isset($_POST['chkEst']) ? 1 : 0;
            $codcli = $_POST['codcli'];
            $codemp = $_POST['codemp'];

            // Armar array de productos
            $productos = [];
            foreach ($_POST['productos'] as $i => $codpro) {
                $productos[] = [
                    'codpro' => $codpro,
                    'cantidad' => $_POST['cantidades'][$i],
                    'precio' => $_POST['precios'][$i]
                ];
            }

            $modeloTicket = new TicketPedido();
            $modeloTicket->registrar($estado, $codcli, $codemp, $productos);

            // Redirigir al listado
            header("Location: /ciberelectrica/public/?controller=ticketpedido&action=listar");
            exit;
        }
    }

    public function menu()
    {
        require_once __DIR__ . '/../views/menuprincipal.php';
    }
}
?>