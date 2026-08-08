<?php
session_start();
// El empleado ya existe en sesión
$empleado = $_SESSION['empleado'];
// Número de ticket
$numeroTicket = $numeroTicket ?? 0;
// Productos desde controlador
$productos = $productos ?? [];
// Clientes desde controlador (para el modal)
$clientes = $clientes ?? null;
$totalPaginas = $totalPaginas ?? 0;
$pagina = $pagina ?? 1;
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro de Ticket de Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function actualizarFechaHora() {
            var fecha = new Date();
            var dia = String(fecha.getDate()).padStart(2, '0');
            var mes = String(fecha.getMonth() + 1).padStart(2, '0');
            var anio = fecha.getFullYear();
            var hora = String(fecha.getHours()).padStart(2, '0');
            var minutos = String(fecha.getMinutes()).padStart(2, '0');
            var segundos = String(fecha.getSeconds()).padStart(2, '0');
            var fechaHora = dia + '/' + mes + '/' + anio + ' ' + hora + ':' + minutos + ':' + segundos;
            document.getElementById("txtFec").value = fechaHora;
        }
        
        setInterval(actualizarFechaHora, 1000);
        window.onload = actualizarFechaHora;
        
        function actualizarProducto(sel, index) {
            let cod = sel.options[sel.selectedIndex].getAttribute("data-cod");
            let pre = sel.options[sel.selectedIndex].getAttribute("data-pre");
            document.getElementById("cod_" + index).value = cod || "";
            document.getElementById("pre_" + index).value = pre || "";
        }
        
        function agregarFila() {
            let tabla = document.getElementById("detallePedido");
            let index = tabla.rows.length;
            let fila = tabla.insertRow();
                
            // Obtener los options del select oculto
            let optionsHTML = document.getElementById("productosOpciones").innerHTML;
                
            // Crear las celdas
            let celdaCodigo = fila.insertCell(0);
            let celdaProducto = fila.insertCell(1);
            let celdaPrecio = fila.insertCell(2);
            let celdaCantidad = fila.insertCell(3);
            let celdaEliminar = fila.insertCell(4);
                
            // Asignar contenido a cada celda
            celdaCodigo.innerHTML = "<input type='text' class='form-control' name='codigos[" + index + "]' id='cod_" + index + "' readonly>";
            celdaProducto.innerHTML = "<select class='form-select' name='productos[" + index + "]' onchange='actualizarProducto(this," + index + ")' required>" +
            "<option value=''>Seleccione</option>" + optionsHTML + "</select>";
            celdaPrecio.innerHTML = "<input type='text' class='form-control' name='precios[" + index + "]' id='pre_" + index + "' readonly>";
            celdaCantidad.innerHTML = "<input type='number' class='form-control' name='cantidades[" + index + "]' min='1' required>";
            celdaEliminar.innerHTML = "<button type='button' class='btn btn-danger' onclick='eliminarFila(this)'>Eliminar</button>";
                
            document.getElementById("txtCanPed").value = tabla.rows.length;
}
        
        function eliminarFila(btn) {
            let tabla = document.getElementById("detallePedido");
            if (tabla.rows.length > 1) {
                btn.closest("tr").remove();
                document.getElementById("txtCanPed").value = tabla.rows.length;
            }
        }
        
        function seleccionarCliente(cod, nombre) {
            document.getElementById("codcli").value = cod;
            document.getElementById("nomcli").value = nombre;
            var modal = bootstrap.Modal.getInstance(document.getElementById('modalClientes'));
            modal.hide();
        }
        
        function filtrarClientes() {
            let filtro = document.getElementById("filtroCliente").value.toLowerCase();
            let filas = document.querySelectorAll("#tablaClientes tbody tr");
            filas.forEach(fila => {
                let nombre = fila.querySelectorAll("td")[1].textContent.toLowerCase();
                fila.style.display = nombre.includes(filtro) ? "" : "none";
            });
        }
    </script>
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            
            <div class="card-header bg-dark text-white">
                
                <h1>Registro de Ticket de Pedido</h1>
            </div>
            <div class="card-body">
                <form method="post" action="/ciberelectrica/public/?controller=ticketpedido&action=registrar">
                    <!-- Cabecera -->
                    <div class="mb-3">
                        <label class="form-label">Número de Ticket:</label>
                        <input type="text" class="form-control" readonly value="<?= $numeroTicket; ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Fecha y Hora:</label>
                        <input type="text" class="form-control" id="txtFec" name="txtFec" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Empleado:</label>
                        <input type="hidden" name="codemp" value="<?= $empleado['codemp']; ?>">
                        <input type="text" class="form-control" readonly value="<?= $empleado['nomemp'] . ' ' . $empleado['apepemp'] . ' ' . $empleado['apememp']; ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Cliente:</label>
                        <input type="text" class="form-control" id="nomcli" name="nomcli" readonly>
                        <input type="hidden" name="codcli" id="codcli">
                        <button type="button" class="btn btn-dark mt-2" data-bs-toggle="modal" data-bs-target="#modalClientes">
                            Buscar Cliente
                        </button>
                    </div>
                    
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="chkEst" name="chkEst" value="1" checked>
                        <label class="form-check-label" for="chkEst">Habilitado</label>
                    </div>
                    
                    <!-- Detalle -->
                    <hr>
                    <h3>Detalle de Pedido</h3>
                    
                    <div class="mb-3">
                        <label class="form-label">Cantidad de productos</label>
                        <input type="text" class="form-control" id="txtCanPed" name="txtCanPed" readonly value="1">
                    </div>
                    
                    <button type="button" class="btn btn-dark mb-3" onclick="agregarFila()">Agregar Producto</button>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>Código</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody id="detallePedido">
                                <tr>
                                    <td><input type="text" class="form-control" id="cod_0" name="codigos[0]" readonly></td>
                                    <td>
                                        <select class="form-select" name="productos[0]" onchange="actualizarProducto(this,0)" required>
                                            <option value="">Seleccione</option>
                                            <?php foreach ($productos as $p): ?>
                                                <option value="<?= $p['codpro']; ?>" data-cod="<?= $p['codpro']; ?>" data-pre="<?= $p['prepro']; ?>">
                                                    <?= $p['nompro']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td><input type="text" class="form-control" id="pre_0" name="precios[0]" readonly></td>
                                    <td><input type="number" class="form-control" name="cantidades[0]" min="1" required></td>
                                    <td><button type="button" class="btn btn-danger" onclick="eliminarFila(this)">Eliminar</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Opciones ocultas -->
                    <select id="productosOpciones" style="display:none;">
                        <?php foreach ($productos as $p): ?>
                            <option value="<?= $p['codpro']; ?>" data-cod="<?= $p['codpro']; ?>" data-pre="<?= $p['prepro']; ?>">
                                <?= $p['nompro']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    
                    <!-- Botones -->
                    <div class="mt-3">
                        <button type="submit" class="btn btn-success">Registrar Ticket</button>
                        <a href="/ciberelectrica/public/?controller=ticketpedido&action=listar" class="btn btn-dark">Regresar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Modal Buscar Cliente -->
    <div class="modal fade" id="modalClientes" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title">Buscar Cliente</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="filtroCliente" class="form-control mb-3" placeholder="Escriba nombre para filtrar..." onkeyup="filtrarClientes()">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tablaClientes">
                            <thead class="table-dark">
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre Completo</th>
                                    <th>Documento</th>
                                    <th>Celular</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($clientes && $clientes->num_rows > 0): ?>
                                    <?php while ($fila = $clientes->fetch_assoc()): ?>
                                        <tr>
                                            <td><?= $fila['codcli']; ?></td>
                                            <td><?= htmlspecialchars($fila['nomcli'] . ' ' . $fila['apepcli'] . ' ' . $fila['apemcli']); ?></td>
                                            <td><?= $fila['doccli']; ?></td>
                                            <td><?= $fila['celcli']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-success btn-sm" onclick="seleccionarCliente('<?= $fila['codcli']; ?>', '<?= htmlspecialchars($fila['nomcli'] . ' ' . $fila['apepcli'] . ' ' . $fila['apemcli']); ?>')">
                                                    Seleccionar
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">No hay clientes habilitados</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Paginación -->
                    <?php if ($totalPaginas > 1): ?>
                        <nav>
                            <ul class="pagination justify-content-center">
                                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                                    <li class="page-item <?= ($i == $pagina) ? 'active' : ''; ?>">
                                        <a class="page-link" href="/ciberelectrica/public/?controller=ticketpedido&action=registro&page=<?= $i; ?>">
                                            <?= $i; ?>
                                        </a>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </nav>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>