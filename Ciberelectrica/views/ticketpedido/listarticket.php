<?php
$tickets = $tickets ?? null;
$totalPaginas = $totalPaginas ?? 0;
$pagina = $pagina ?? 1;
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CiberElectrik | Listado de Tickets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function imprimirTicket() {
            // Seleccionamos el contenido del modal
            var modalBody = document.querySelector('.modal-body');
            if (!modalBody) {
                alert("No se encontró el contenido del ticket.");
                return;
            }
            var contenido = modalBody.innerHTML;
            var ventana = window.open('', '', 'width=800,height=600');
            ventana.document.write('<html><head><title>Ticket de Pedido</title>');
            ventana.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">');
            ventana.document.write('</head><body>');
            ventana.document.write(contenido);
            ventana.document.write('</body></html>');
            ventana.document.close();
            ventana.print();
        }
    </script>
</head>
<body>
    <div class="container">
        <!-- inicio del menu -->
        <?php include __DIR__ . '/../templates/menu.php'; ?>
    <!-- fin del menu -->

   <!-- inicio del contenido -->
        <div class="container body-content">
            <h1>Listado de Ticket de Pedido</h1>
            <div>
                <a href="/ciberelectrica/public/?controller=ticketpedido&action=registro" class="btn btn-primary">Registrar Ticket de Pedido</a>
                <a href="/ciberelectrica/public/?controller=ticketpedido&action=habilita" class="btn btn-warning">Habilitar Ticket de Pedido</a>
                <a href="/ciberelectrica/public/?controller=ticketpedido&action=menu" class="btn btn-dark">Regresar</a>
            </div>
            <div class="mb-3"></div>
        <!-- inicio de la tabla -->
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Nro Ticket</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Empleado</th>
                        <th>Subtotal</th>
                        <th>Estado</th>
                        <th>Anular</th>
                        <th>Habilitar</th>
                        <th>Detalles</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($tickets && $tickets->num_rows > 0): ?>
                        <?php while ($fila = $tickets->fetch_assoc()): ?>
                            <tr>
                                <td><?= $fila['nrotic']; ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($fila['fectic'])); ?></td>
                                <td><?= htmlspecialchars($fila['nomcli'] . ' ' . $fila['apepcli'] . ' ' . $fila['apemcli']); ?></td>
                                <td><?= htmlspecialchars($fila['nomemp'] . ' ' . $fila['apepemp'] . ' ' . $fila['apememp']); ?></td>
                                <td>S/. <?= number_format($fila['subtotal'], 2); ?></td>
                                <td>
                                    <?php if ($fila['esttic'] == 1): ?>
                                        <span class="badge bg-success">Habilitado</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Anulado</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="/ciberelectrica/public/?controller=ticketpedido&action=anular&id=<?= $fila['nrotic']; ?>" 
                                    class="btn btn-danger btn-sm" 
                                    onclick="return confirm('¿Deseas anular este ticket de pedido?')">
                                        Anular
                                    </a>
                                </td>
                                <td>
                                    <a href="/ciberelectrica/public/?controller=ticketpedido&action=habilitar&id=<?= $fila['nrotic']; ?>" 
                                    class="btn btn-warning btn-sm" 
                                    onclick="return confirm('¿Deseas habilitar este ticket de pedido?')">
                                        Habilitar
                                    </a>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-dark btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#detalleModal"
                                            onclick="cargarDetalle(<?= $fila['nrotic']; ?>)">
                                        Detalles
                                    </button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center">No existen tickets registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <!-- fin de la tabla -->
        
        <!-- paginación -->
        <?php if ($totalPaginas > 1): ?>
            <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item <?= ($pagina <= 1) ? 'disabled' : ''; ?>">
                        <a class="page-link bg-dark text-white border-dark" 
                        href="/ciberelectrica/public/?controller=ticketpedido&action=listar&page=<?= $pagina - 1; ?>">
                            Anterior
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                        <li class="page-item <?= ($i == $pagina) ? 'active' : ''; ?>">
                            <a class="page-link <?= ($i == $pagina) ? 'bg-secondary text-white border-secondary' : 'bg-dark text-white border-dark'; ?>" 
                            href="/ciberelectrica/public/?controller=ticketpedido&action=listar&page=<?= $i; ?>">
                                <?= $i; ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?= ($pagina >= $totalPaginas) ? 'disabled' : ''; ?>">
                        <a class="page-link bg-dark text-white border-dark" 
                        href="/ciberelectrica/public/?controller=ticketpedido&action=listar&page=<?= $pagina + 1; ?>">
                            Siguiente
                        </a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
    
    <!-- Modal Detalle -->
    <div class="modal fade" id="detalleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="detalleContenido">
                <!-- Aquí se cargará el detalle vía AJAX -->
            </div>
        </div>

        </div>
        <!-- findel contenido -->
        <!-- inicio del footer -->
        <?php include __DIR__ . '/../templates/pie.php'; ?>
        <!-- fin del footer -->
         
    </div>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function cargarDetalle(idTicket) {
            fetch('/ciberelectrica/public/?controller=ticketpedido&action=detalle&id=' + idTicket)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('detalleContenido').innerHTML = html;
                });
        }
        
    </script>
</body>
</html>