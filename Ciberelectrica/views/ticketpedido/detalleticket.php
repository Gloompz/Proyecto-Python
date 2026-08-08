<?php
$detalle = $detalle ?? null;
$cabecera = $cabecera ?? null;
$id = $_GET['id'] ?? 0;
$ticket = ($cabecera && $cabecera->num_rows > 0) ? $cabecera->fetch_assoc() : null;
?>
<div class="modal-header bg-dark text-white">
    <h5 class="modal-title">Ticket de Pedido</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
    <!-- Cabecera estilo ticket -->
    <?php if ($ticket): ?>
        <div class="card border-secondary mb-3">
            <div class="card-header bg-secondary text-white fw-bold">
                Datos del Ticket
            </div>
            <div class="card-body">
                <p><strong>Número de Ticket:</strong> <?= $ticket['nrotic']; ?></p>
                <p><strong>Fecha y Hora:</strong> <?= date('d/m/Y H:i', strtotime($ticket['fectic'])); ?></p>
                <p><strong>Empleado:</strong> <?= htmlspecialchars($ticket['nomemp'] . ' ' . $ticket['apepemp'] . ' ' . $ticket['apememp']); ?></p>
                <p><strong>Cliente:</strong> <?= htmlspecialchars($ticket['nomcli'] . ' ' . $ticket['apepcli'] . ' ' . $ticket['apemcli']); ?></p>
                <p><strong>Dirección:</strong> <?= htmlspecialchars($ticket['dircli']); ?></p>
                <p><strong>Teléfono:</strong> <?= $ticket['celcli']; ?></p>
            </div>
        </div>
    <?php endif; ?>
    
    <!-- Detalle de productos -->
    <div class="card border-dark">
        <div class="card-header bg-dark text-white fw-bold">
            Detalle de Productos
        </div>
        <div class="card-body p-0">
            <table class="table table-sm table-bordered mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $subtotal = 0;
                    if ($detalle && $detalle->num_rows > 0):
                        while ($fila = $detalle->fetch_assoc()):
                            $subtotal += $fila['total'];
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($fila['nompro']); ?></td>
                            <td><?= $fila['cantic']; ?></td>
                            <td>S/. <?= number_format($fila['pretic'], 2); ?></td>
                            <td>S/. <?= number_format($fila['total'], 2); ?></td>
                        </tr>
                    <?php 
                        endwhile;
                    else: 
                    ?>
                        <tr>
                            <td colspan="4" class="text-center">No hay detalle registrado</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Totales -->
    <div class="text-end mt-3">
        <p><strong>Subtotal:</strong> S/. <?= number_format($subtotal, 2); ?></p>
        <p><strong>IGV (18%):</strong> S/. <?= number_format($subtotal * 0.18, 2); ?></p>
        <p class="fw-bold text-primary"><strong>Total:</strong> S/. <?= number_format($subtotal * 1.18, 2); ?></p>
    </div>
</div>
<div class="modal-footer bg-light">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
    <!-- Botón Imprimir -->
    <button type="button" class="btn btn-primary" onclick="imprimirTicket()">Imprimir</button>
</div>
<script>
    function imprimirTicket() {
        // Seleccionamos el contenido del modal
        var contenido = document.querySelector('.modal-body').innerHTML;
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