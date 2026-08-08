<!-- Inicializando listado de productos -->
<?php
$productos = $productos ?? null;
$totalPaginas = $totalPaginas ?? 0;
$pagina = $pagina ?? 1;
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CiberElectrik | Habilitar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- inicio del menu -->
        <?php include __DIR__ . '/../templates/menu.php'; ?>
        <!-- fin del menu -->


        <!-- inicio del contenido -->
        <div class="container body-content">


    <div class="mt-4">
        <h1>Habilitación de Productos</h1>
        <a href="/ciberelectrica/public/?controller=producto&action=listar" class="btn btn-dark">Regresar al Listado</a>
    </div>

    <div class="mb-3"></div>

        <!-- inicio de la tabla -->
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Fecha Ingreso</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Marca</th>
                        <th>Categoría</th>
                        <th>Estado</th>
                        <th>Habilitar</th>
                        <th>Deshabilitar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($productos && $productos->num_rows > 0): ?>
                        <?php while ($fila = $productos->fetch_assoc()): ?>
                            <tr>
                                <td><?= $fila['codpro']; ?></td>
                                <td><?= htmlspecialchars($fila['nompro']); ?></td>
                                <td><?= htmlspecialchars($fila['despro']); ?></td>
                                <td><?= date('d/m/Y', strtotime($fila['fecing'])); ?></td>
                                <td>S/. <?= number_format($fila['prepro'], 2); ?></td>
                                <td><?= $fila['canpro']; ?></td>
                                <td><?= htmlspecialchars($fila['nommar']); ?></td>
                                <td><?= htmlspecialchars($fila['nomcat']); ?></td>
                                <td>
                                    <?php if ($fila['estpro'] == 1): ?>
                                        <span class="text-success fwbold">Habilitado</span>
                                    <?php else: ?>
                                        <span class="text-danger fwbold">Deshabilitado</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="/ciberelectrica/public/?controller=producto&action=habilitar&id=<?= $fila['codpro']; ?>" class="btn btn-warning">
                                        Habilitar
                                    </a>
                                </td>
                                <td>
                                    <a href="/ciberelectrica/public/?controller=producto&action=deshabilitar&id=<?= $fila['codpro']; ?>" class="btn btn-danger" onclick="return confirm('¿Deseas deshabilitar este producto?')">
                                        Deshabilitar
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="11" class="text-center">No existen productos registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <!-- fin de la tabla -->

        <!-- inicio de paginación -->
        <?php if ($totalPaginas > 1): ?>
            <nav>
                <ul class="pagination justify-content-center">
                    <!-- ANTERIOR -->
                    <li class="page-item <?= ($pagina <= 1) ? 'disabled' : ''; ?>">
                        <a class="page-link bg-dark text-white border-dark" href="/ciberelectrica/public/?controller=producto&action=habilita&page=<?= $pagina - 1; ?>">
                            Anterior
                        </a>
                    </li>

                    <!-- PAGINAS -->
                    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                        <li class="page-item <?= ($i == $pagina) ? 'active' : ''; ?>">
                            <a class="page-link <?= ($i == $pagina) ? 'bg-secondary text-white border-secondary' : 'bg-dark text-white border-dark'; ?>" href="/ciberelectrica/public/?controller=producto&action=habilita&page=<?= $i; ?>">
                                <?= $i; ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <!-- SIGUIENTE -->
                    <li class="page-item <?= ($pagina >= $totalPaginas) ? 'disabled' : ''; ?>">
                        <a class="page-link bg-dark text-white border-dark" href="/ciberelectrica/public/?controller=producto&action=habilita&page=<?= $pagina + 1; ?>">
                            Siguiente
                        </a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
        <!-- fin de paginación -->
         </div>
        <!-- findel contenido -->
        <!-- inicio del footer -->
        <?php include __DIR__ . '/../templates/pie.php'; ?>
        <!-- fin del footer -->
         
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>