<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CiberElectrik | Registrar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container">
    <!-- inicio del menu -->
        <?php include __DIR__ . '/../templates/menu.php'; ?>
        <!-- fin del menu -->

    <div class="container body-content">

    <div class="container mt-4 mb-5">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white py-3">
                <h1 class="h4 mb-0">Registro de Cliente</h1>
            </div>
            </div class="card-body p-4">
                <form action="/ciberelectrica/public/?controller=cliente&action=registrar" method="post">

        <div class="row">
            <div class="mb-3 col-6">
                <label for="txtNom" class="form-label" fw-semibold>Nombre:</label>
                <input type="text" class="form-control" id="txtNom" name="txtNom" placeholder="Ingrese el Nombre" required>
            </div>
            <div class="mb-3 col-6">
                <label for="txtApep" class="form-label" fw-semibold>Apellido Paterno:</label>
                <input type="text" class="form-control" id="txtApep" name="txtApep" placeholder="Ingrese el Apellido Paterno" required>
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-6">
                <label for="txtApem" class="form-label" fw-semibold>Apellido Materno:</label>
                <input type="text" class="form-control" id="txtApem" name="txtApem" placeholder="Ingrese el Apellido Materno" required>
            </div>
            <div class="mb-3 col-6">
                <label for="selTip" class="form-label" fw-semibold>Tipo de Documento:</label>
                <select class="form-select" id="selTip" name="selTip" required>
                    <option value="">Seleccione el Tipo de Documento </option>
                    <?php if (isset($tiposdoc) && $tiposdoc ->num_rows > 0): ?>
                        <?php while ($fila = $tiposdoc -> fetch_assoc()): ?> 
                        <option value ="<?= $fila['codtipd']; ?>">
                            <?= htmlspecialchars($fila['nomtipd']); ?>
                        </option>
                        <?php endwhile; ?>
                        <?php endif; ?>
                </select>
            </div>
            </div>

            <div class="row">
            <div class="mb-3 col-6">
                <label for="txtDoc" class="form-label" fw-semibold>Numero de Documento:</label>
                <input type="number" class="form-control" id="txtDoc" name="txtDoc" placeholder="Ingrese el numero de documento" required>
            </div>
            <div class="mb-3 col-6">
                <label for="txtFec" class="form-label fw-semibold">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" id="txtFec" name="txtFec" required>
            </div>
            </div>

            <div class="row">
            <div class="mb-3 col-6">
                <label for="txtPre" class="form-label" fw-semibold>Direccion:</label>
                <textarea class="form-control" id="txtDir" name="txtDir" placeholder="Ingrese la dirección" rows="3" required> </textarea>
            </div>
            <div class="mb-3 col-6">
                <label for="selDis" class="form-label">Distrito:</label>
                <select class="form-select" id="selDis" name="selDis" required>
                    <option value="">Seleccione el Distrito </option>
                    <?php if (isset($distritos) && $distritos ->num_rows > 0): ?>
                        <?php while ($fila = $distritos -> fetch_assoc()): ?> 
                        <option value ="<?= $fila['coddis']; ?>">
                            <?= htmlspecialchars($fila['nomdis']); ?>
                        </option>
                        <?php endwhile; ?>
                        <?php endif; ?>
                </select>
            </div>
            </div>

            <div class="row">
            <div class="mb-3 col-6">
                <label for="txtTel" class="form-label" fw-semibold>Telefono:</label>
                <input type="tel" class="form-control" id="txtTel" name="txtTel" required>
            </div>
            <div class="mb-3 col-6">
                <label for="txtCel" class="form-label" fw-semibold>Celular:</label>
                <input type="number" class="form-control" id="txtCel" name="txtCel" required>
            </div>
            </div>

            <div class="row">
            <div class="mb-3 col-6">
                <label for="txtCor" class="form-label" fw-semibold>Correo:</label>
                <input type="email" class="form-control" id="txtCor" name="txtCor" required>
            </div>
            <div class="mb-3 col-6">
                <label for="selSex" class="form-label" fw-semibold>Sexo:</label>
                <select class="form-select" id="selSex" name="selSex" required>
                    <option value="">Seleccione el Sexo </option>
                    <?php if (isset($sexos) && $sexos ->num_rows > 0): ?>
                        <?php while ($fila = $sexos -> fetch_assoc()): ?> 
                        <option value ="<?= $fila['codsex']; ?>">
                            <?= htmlspecialchars($fila['nomsex']); ?>
                        </option>
                        <?php endwhile; ?>
                        <?php endif; ?>
                </select>
            </div>
            </div>

            <div class="mb-3 col-6">
                <label for="chkEst" class="form-label" fw-semibold>Estado:</label>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="chkEst" name="chkEst">
                    <label class="form-check-label" for="chkEst">Habilitado</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>
            <a href="/ciberelectrica/public/?controller=cliente&action=listar" class="btn btn-dark">Regresar</a>
        </form>
        </div>
    </div>

    </div>
        <!-- findel contenido -->
        <!-- inicio del footer -->
        <?php include __DIR__ . '/../templates/pie.php'; ?>
        <!-- fin del footer -->
         
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>