<!-- inicializando el valor de producto -->
<?php
$producto = $producto ?? [
    'codpro' => '',
    'nompro' => '',
    'despro' => '',
    'fecing' => date('Y-m-d'),
    'prepro' => 0,
    'canpro' => 0,
    'codmar' => '',
    'codcat' => '',
    'estpro' => 0
];
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CiberElectrik | Actualizar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
         <!-- inicio del menu -->
        <?php include __DIR__ . '/../templates/menu.php'; ?>
        <!-- fin del menu -->

        <!-- inicio del contenido -->
        <div class="container body-content">
            
        <h1>Actualización de Producto</h1>

        <!-- inicio del formulario -->
        <form action="/ciberelectrica/public/?controller=producto&action=actualizar" method="post">
            <div class="mb-3 col-6">
                <label for="txtCod" class="form-label">Código:</label>
                <input type="text" class="form-control" id="txtCod" name="txtCod" readonly value="<?= $producto['codpro']; ?>">
            </div>

            <div class="mb-3 col-6">
                <label for="txtNom" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="txtNom" name="txtNom" value="<?= htmlspecialchars($producto['nompro']); ?>" required>
            </div>

            <div class="mb-3 col-6">
                <label for="txtDes" class="form-label">Descripción:</label>
                <textarea class="form-control" id="txtDes" name="txtDes" required><?= htmlspecialchars($producto['despro']); ?></textarea>
            </div>

            <div class="mb-3 col-6">
                <label for="txtFec" class="form-label">Fecha de Ingreso:</label>
                <input type="date" class="form-control" id="txtFec" name="txtFec" value="<?= $producto['fecing']; ?>" required>
            </div>

            <div class="mb-3 col-6">
                <label for="txtPre" class="form-label">Precio:</label>
                <input type="number" step="0.01" class="form-control" id="txtPre" name="txtPre" value="<?= $producto['prepro']; ?>" required>
            </div>

            <div class="mb-3 col-6">
                <label for="txtCan" class="form-label">Cantidad:</label>
                <input type="number" class="form-control" id="txtCan" name="txtCan" value="<?= $producto['canpro']; ?>" required>
            </div>

            <div class="mb-3 col-6">
                <label for="selMar" class="form-label">Marca:</label>
                <select class="form-select" id="selMar" name="selMar" required>
                    <?php if (isset($marcas) && $marcas->num_rows > 0): ?>
                        <?php while ($fila = $marcas->fetch_assoc()): ?>
                            <option value="<?= $fila['codmar']; ?>" <?= ($fila['codmar'] == $producto['codmar']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($fila['nommar']); ?>
                            </option>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="mb-3 col-6">
                <label for="selCat" class="form-label">Categoría:</label>
                <select class="form-select" id="selCat" name="selCat" required>
                    <?php if (isset($categorias) && $categorias->num_rows > 0): ?>
                        <?php while ($fila = $categorias->fetch_assoc()): ?>
                            <option value="<?= $fila['codcat']; ?>" <?= ($fila['codcat'] == $producto['codcat']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($fila['nomcat']); ?>
                            </option>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="mb-3 col-6">
                <label for="chkEst" class="form-label">Estado:</label>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="chkEst" name="chkEst" <?= ($producto['estpro'] == 1) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="chkEst">Habilitado</label>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="/ciberelectrica/public/?controller=producto&action=listar" class="btn btn-dark">Regresar</a>
        </form>
        <!-- fin del formulario -->
         </div>
        <!-- findel contenido -->
        <!-- inicio del footer -->
        <?php include __DIR__ . '/../templates/pie.php'; ?>
        <!-- fin del footer -->

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>