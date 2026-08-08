<?php
$clientes = $clientes ?? null;
$totalPaginas = $totalPaginas ?? 0;
$pagina = $pagina ?? 1;
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CiberElectrik | Habilitar Cliente</title>
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
        <h1>Habilitación de Clientes</h1>
        <a href="/ciberelectrica/public/?controller=cliente&action=listar" class="btn btn-dark">Regresar al Listado</a>
    </div>

    <div class="mb-3"></div>

        <!-- inicio de la tabla -->
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Documento</th>
                        <th>Fecha</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
                        <th>Celular</th>
                        <th>Correo</th>
                        <th>Distrito</th>
                        <th>Sexo</th>
                        <th>Tipo de Documento</th>
                        <th>Estado</th>
                        <th>Actualizar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($clientes && $clientes->num_rows > 0): ?>
                        <?php while ($fila = $clientes->fetch_assoc()): ?>
                            <tr>
                                <td><?= $fila['codcli']; ?></td>
                                <td><?= htmlspecialchars($fila['nomcli']); ?></td>
                                <td><?= htmlspecialchars($fila['apepcli']); ?></td>
                                <td><?= htmlspecialchars($fila['apemcli']); ?></td>
                                <td><?= htmlspecialchars($fila['doccli']); ?></td>
                                <td><?= date('d/m/Y', strtotime($fila['feccli'])); ?></td>
                                <td><?= htmlspecialchars($fila['dircli']); ?></td>
                                <td><?= htmlspecialchars($fila['telcli']); ?></td>
                                <td><?= htmlspecialchars($fila['celcli']); ?></td>
                                <td><?= htmlspecialchars($fila['corcli']); ?></td>
                                <td><?= htmlspecialchars($fila['nomdis']); ?></td>
                                <td><?= htmlspecialchars($fila['nomsex']); ?></td>
                                <td><?= htmlspecialchars($fila['nomtipd']); ?></td>
                                <td>
                                    <?php if ($fila['estcli'] == 1): ?>
                                        <span class="text-success">Habilitado</span>
                                    <?php else: ?>
                                        <span class="text-danger">Deshabilitado</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="/ciberelectrica/public/?controller=cliente&action=habilitar&id=<?= $fila['codcli']; ?>" class="btn btn-success">
                                        Habilitar
                                    </a>
                                </td>
                                <td>
                                    <a href="/ciberelectrica/public/?controller=cliente&action=deshabilitar&id=<?= $fila['codcli']; ?>" class="btn btn-danger" onclick="return confirm('¿Deseas eliminar este cliente?')">
                                        Deshabilitar
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="11" class="text-center">No existen clientes registrados</td>
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
                        <a class="page-link bg-dark text-white border-dark" href="/ciberelectrica/public/?controller=cliente&action=habilita&page=<?= $pagina - 1; ?>">
                            Anterior
                        </a>
                    </li>

                    <!-- PAGINAS -->
                    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                        <li class="page-item <?= ($i == $pagina) ? 'active' : ''; ?>">
                            <a class="page-link <?= ($i == $pagina) ? 'bg-secondary text-white border-secondary' : 'bg-dark text-white border-dark'; ?>" href="/ciberelectrica/public/?controller=cliente&action=habilita&page=<?= $i; ?>">
                                <?= $i; ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <!-- SIGUIENTE -->
                    <li class="page-item <?= ($pagina >= $totalPaginas) ? 'disabled' : ''; ?>">
                        <a class="page-link bg-dark text-white border-dark" href="/ciberelectrica/public/?controller=cliente&action=habilita&page=<?= $pagina + 1; ?>">
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