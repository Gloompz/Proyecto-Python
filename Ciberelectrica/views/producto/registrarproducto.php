<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CiberElectrik | Registrar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- inicio del menu -->
        <?php include __DIR__ . '/../templates/menu.php'; ?>
        <!-- fin del menu -->

    <div class="container body-content">

        <h1>Registro de Producto</h1>

        <!-- inicio del formulario -->
        <form action="/ciberelectrica/public/?controller=producto&action=registrar" method="post">
            <div class="mb-3 col-6">
                <label for="txtNom" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="txtNom" name="txtNom" placeholder="Ingrese el nombre" required>
            </div>

            <div class="mb-3 col-6">
                <label for="txtDes" class="form-label">Descripción:</label>
                <textarea class="form-control" id="txtDes" name="txtDes" placeholder="Ingrese la descripción" required></textarea>
            </div>

            <div class="mb-3 col-6">
                <label for="txtFec" class="form-label">Fecha de Ingreso:</label>
                <input type="date" class="form-control" id="txtFec" name="txtFec" required>
            </div>

            <div class="mb-3 col-6">
                <label for="txtPre" class="form-label">Precio:</label>
                <input type="number" step="0.01" class="form-control" id="txtPre" name="txtPre" placeholder="Ingrese el precio" required>
            </div>

            <div class="mb-3 col-6">
                <label for="txtCan" class="form-label">Cantidad:</label>
                <input type="number" class="form-control" id="txtCan" name="txtCan" placeholder="Ingrese la cantidad" required>
            </div>

            <div class="mb-3 col-6">
                <label for="selMar" class="form-label">Marca:</label>
                <select class="form-select" id="selMar" name="selMar" required>
                    <option value="">Seleccione una marca</option>
                    <?php if (isset($marcas) && $marcas->num_rows > 0): ?>
                        <?php while ($fila = $marcas->fetch_assoc()): ?>
                            <option value="<?= $fila['codmar']; ?>"><?= htmlspecialchars($fila['nommar']); ?></option>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="mb-3 col-6">
                <label for="selCat" class="form-label">Categoría:</label>
                <select class="form-select" id="selCat" name="selCat" required>
                    <option value="">Seleccione una categoría</option>
                    <?php if (isset($categorias) && $categorias->num_rows > 0): ?>
                        <?php while ($fila = $categorias->fetch_assoc()): ?>
                            <option value="<?= $fila['codcat']; ?>"><?= htmlspecialchars($fila['codcat']); ?></option>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="mb-3 col-6">
                <label for="chkEst" class="form-label">Estado:</label>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="chkEst" name="chkEst">
                    <label class="form-check-label" for="chkEst">Habilitado</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>
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