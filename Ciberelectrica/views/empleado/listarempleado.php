<?php
$empleados = $empleados ?? null;
$totalPaginas = $totalPaginas ?? 0;
$pagina = $pagina ?? 1;
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CiberElectrik | Mostrar Empleado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- inicio del menu -->
        <?php include __DIR__ . '/../templates/menu.php'; ?>
    <!-- fin del menu -->

   <!-- inicio del contenido -->
        <div class="container body-content">
            <h1>Listado de Empleado</h1>
            <div>
                <a href="/ciberelectrica/public/?controller=empleado&action=registro" class="btn btn-primary">Registrar Empleado</a>
                <a href="/ciberelectrica/public/?controller=empleado&action=habilita" class="btn btn-warning">Habilitar Empleado</a>
                <a href="/ciberelectrica/public/?controller=empleado&action=menu" class="btn btn-dark">Regresar</a>
            </div>
            <div class="mb-3"></div>

        <!-- inicio de la tabla -->
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>A. Paterno</th>
                        <th>A. Materno</th>
                        <th>T. Documento</th>
                        <th>Num. Documento</th>
                        <th>Fec. Nacimiento</th>
                        <th>Dirección</th>
                        <th>Distrito</th>
                        <th>Teléfono</th>
                        <th>Celular</th>
                        <th>Correo</th>
                        <th>Usuario</th>
                        <th>Clave</th>
                        <th>Sueldo</th>
                        <th>Fec. Ingreso</th>
                        <th>Especialización</th>
                        <th>Rol</th>
                        <th>Sexo</th>
                        <th>Estado Civil</th>
                        <th>Grado Instrucción</th>
                        <th>Estado</th>
                        <th>Actualizar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($empleados && $empleados->num_rows > 0): ?>
                        <?php while ($fila = $empleados->fetch_assoc()): ?>
                            <tr>
                                <td><?= $fila['codemp']; ?></td>
                                <td><?= htmlspecialchars($fila['nomemp']); ?></td>
                                <td><?= htmlspecialchars($fila['apepemp']); ?></td>
                                <td><?= htmlspecialchars($fila['apememp']); ?></td>
                                <td><?= htmlspecialchars($fila['nomtipd']); ?></td>
                                <td><?= htmlspecialchars($fila['docemp']); ?></td>
                                <td><?= date('d/m/Y', strtotime($fila['fecemp'])); ?></td>
                                <td><?= htmlspecialchars($fila['diremp']); ?></td>
                                <td><?= htmlspecialchars($fila['nomdis']); ?></td>
                                <td><?= htmlspecialchars($fila['telemp']); ?></td>
                                <td><?= htmlspecialchars($fila['celemp']); ?></td>
                                <td><?= htmlspecialchars($fila['coremp']); ?></td>
                                <td><?= htmlspecialchars($fila['usuemp']); ?></td>
                                <td><?= htmlspecialchars($fila['claemp']); ?></td>
                                <td>S/. <?= number_format($fila['sueemp'], 2); ?></td>
                                <td><?= date('d/m/Y', strtotime($fila['fecing'])); ?></td>
                                <td><?= htmlspecialchars($fila['nomesp']); ?></td>
                                <td><?= htmlspecialchars($fila['nomrol']); ?></td>
                                <td><?= htmlspecialchars($fila['nomsex']); ?></td>
                                <td><?= htmlspecialchars($fila['nomestc']); ?></td>
                                <td><?= htmlspecialchars($fila['nomgrai']); ?></td>
                                <td>
                                    <?php if ($fila['estemp'] == 1): ?>
                                        <span class="text-success">Habilitado</span>
                                    <?php else: ?>
                                        <span class="text-danger">Deshabilitado</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="/ciberelectrica/public/?controller=empleado&action=actualiza&id=<?= $fila['codemp']; ?>" class="btn btn-success">
                                        Actualizar
                                    </a>
                                </td>
                                <td>
                                    <a href="/ciberelectrica/public/?controller=empleado&action=eliminar&id=<?= $fila['codemp']; ?>" class="btn btn-danger" onclick="return confirm('¿Deseas eliminar este empleado?')">
                                        Eliminar
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="11" class="text-center">No existen empleado registrados</td>
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
                        <a class="page-link bg-dark text-white border-dark" href="/ciberelectrica/public/?controller=empleado&action=listar&page=<?= $pagina - 1; ?>">
                            Anterior
                        </a>
                    </li>

                    <!-- PAGINAS -->
                    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                        <li class="page-item <?= ($i == $pagina) ? 'active' : ''; ?>">
                            <a class="page-link <?= ($i == $pagina) ? 'bg-secondary text-white border-secondary' : 'bg-dark text-white border-dark'; ?>" href="/ciberelectrica/public/?controller=empleado&action=listar&page=<?= $i; ?>">
                                <?= $i; ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <!-- SIGUIENTE -->
                    <li class="page-item <?= ($pagina >= $totalPaginas) ? 'disabled' : ''; ?>">
                        <a class="page-link bg-dark text-white border-dark" href="/ciberelectrica/public/?controller=empleado&action=listar&page=<?= $pagina + 1; ?>">
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