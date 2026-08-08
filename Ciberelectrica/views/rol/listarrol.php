<!-- Inicializando listado de distritos -->
<?php
$rol = $rol ?? null;
$totalPaginas = $totalPaginas ?? 0;
$pagina = $pagina ?? 1;
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CiberElectrik | Listado Rol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"rel="stylesheet"integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"crossorigin="anonymous">
</head>
<body>
<div class="container">
    
    <!-- inicio del menu -->
        <?php include __DIR__ . '/../templates/menu.php'; ?>
    <!-- fin del menu -->


    <!-- inicio del contenido -->
        <div class="container body-content">
            <h1>Listado de Rol</h1>
            <div>
                <a href="/ciberelectrica/public/?controller=rol&action=registro" class="btn btn-primary">Registrar Rol</a>
                <a href="/ciberelectrica/public/?controller=rol&action=habilita" class="btn btn-warning">Habilitar Rol</a>
                <a href="/ciberelectrica/public/?controller=rol&action=menu" class="btn btn-dark">Regresar</a>
            </div>
            <div class="mb-3"></div>


    <!-- inicio de la tabla -->
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Actualizar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($rol) && $rol->num_rows > 0): ?>
                    <?php while ($fila = $rol->fetch_assoc()): ?>
                        <tr>
                            <td><?= $fila['codrol']; ?></td>
                            <td><?= htmlspecialchars($fila['nomrol']); ?></td>
                            <td>
                                <?php if ($fila['estrol'] == 1): ?>
                                    <span class="text-success fw-bold">Habilitado</span>
                                <?php else: ?>
                                    <span class="text-danger fw-bold">Deshabilitado</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="/ciberelectrica/public/?controller=rol&action=actualiza&id=<?= $fila['codrol']; ?>"
                                class="btn btn-warning btn-sm">
                                    Actualizar
                                </a>
                            </td>
                            <td>
                                <a href="/ciberelectrica/public/?controller=rol&action=eliminar&id=<?= $fila['codrol']; ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('¿Deseas eliminar este Rol?')">
                                    Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">
                            No existen distritos registrados
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- fin de la tabla -->

    <!-- inicio de paginación -->
    <?php if (isset($totalPaginas) && $totalPaginas > 1): ?>
    <nav>
        <ul class="pagination justify-content-center">
            <!-- ANTERIOR -->
            <li class="page-item <?= ($pagina <= 1) ? 'disabled' : ''; ?>">
                <a class="page-link bg-dark text-white border-dark"
                href="/ciberelectrica/public/?controller=rol&action=listar&page=<?= $pagina - 1; ?>">
                    Anterior
                </a>
            </li>
            <!-- PAGINAS -->
            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
            <li class="page-item <?= ($i == $pagina) ? 'active' : ''; ?>">
                <a class="page-link <?= ($i == $pagina) ? 'bg-secondary text-white border-secondary' : 'bg-dark text-white border-dark'; ?>"
                href="/ciberelectrica/public/?controller=rol&action=listar&page=<?= $i; ?>">
                    <?= $i; ?>
                </a>
            </li>
            <?php endfor; ?>
            <!-- SIGUIENTE -->
            <li class="page-item <?= ($pagina >= $totalPaginas) ? 'disabled' : ''; ?>">
                <a class="page-link bg-dark text-white border-dark"
                href="/ciberelectrica/public/?controller=rol&action=listar&page=<?= $pagina + 1; ?>">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>
</html>