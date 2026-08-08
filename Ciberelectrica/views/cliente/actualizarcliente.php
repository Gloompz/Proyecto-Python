<!-- inicializando el valor de producto -->
<?php
$clientes = $clientes ?? [
    'codcli' => '',
    'nomcli' => '',
    'apepcli' => '',
    'apemcli' => '',
    'doccli' => '',
    'feccli' => date('Y-m-d'),
    'dircli' => '',
    'telcli' => '',
    'celcli' => '',
    'coddis' => '',
    'codsex' => '',
    'codtipd' => '',
    'estcli' => 0,
];
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CiberElectrik | Actualizar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
         <!-- inicio del menu -->
        <?php include __DIR__ . '/../templates/menu.php'; ?>
        <!-- fin del menu -->

        <!-- inicio del contenido -->
        <div class="container body-content">

        <h1>Actualización de Cliente</h1>

        <!-- inicio del formulario -->
        <form action="/ciberelectrica/public/?controller=cliente&action=actualizar" method="post">
            <div class="mb-3 col-6">
                <label for="txtCod" class="form-label">Código:</label>
                <input type="text" class="form-control" id="txtCod" name="txtCod" readonly value="<?= $clientes['codcli']; ?>">
            </div>

            <div class="mb-3 col-6">
                <label for="txtNom" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="txtNom" name="txtNom" value="<?= htmlspecialchars($clientes['nomcli']); ?>" required>
            </div>

            <div class="mb-3 col-6">
                <label for="txtApep" class="form-label">Apellido Paterno:</label>
                <input type="text" class="form-control" id="txtApep" name="txtApep" value="<?= htmlspecialchars($clientes['apepcli']); ?>" required>
            </div>

            <div class="mb-3 col-6">
                <label for="txtApem" class="form-label">Apellido Materno:</label>
                <input class="form-control" id="txtApem" name="txtApem" required><?= htmlspecialchars($clientes['apemcli']); ?></textarea>
            </div>

            <div class="mb-3 col-6">
                <label for="txtDoc" class="form-label">Numero de Documento:</label>
                <input type="text" class="form-control" id="txtDoc" name="txtDoc" value="<?= htmlspecialchars($clientes['doccli']); ?>" required>
            </div>

            <div class="mb-3 col-6">
                <label for="txtFec" class="form-label">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" id="txtFec" name="txtFec" value="<?= $clientes['feccli']; ?>" required>
            </div>

            <div class="mb-3 col-6">
                <label for="txtPre" class="form-label">Direccion:</label>
                <textarea class="form-control" id="txtDir" required> <?= htmlspecialchars($clientes['dircli']); ?></textarea>
            </div>

            <div class="mb-3 col-6">
                <label for="txtTel" class="form-label">Telefono:</label>
                <input type="number" class="form-control" id="txtTel" name="txtTel" value="<?= $clientes['telcli']; ?>" required>
            </div>

            <div class="mb-3 col-6">
                <label for="txtCan" class="form-label">Celular:</label>
                <input type="number" class="form-control" id="txtCel" name="txtCan" value="<?= $clientes['celcli']; ?>" required>
            </div>
            
            <div class="mb-3 col-6">
                <label for="txtCan" class="form-label">Correo:</label>
                <input type="email" class="form-control" id="txtCan" name="txtCan" value="<?= $clientes['corcli']; ?>" required>
            </div>

            <div class="mb-3 col-6">
                <label for="selTip" class="form-label">Tipo de Documento:</label>
                <select class="form-select" id="selTip" name="selTip" required>
                    <option value="">Seleccione el Tipo de Documento </option>
                    <?php if (isset($tiposdoc) && $tiposdoc ->num_rows > 0): ?>
                        <?php while ($fila = $tiposdoc -> fetch_assoc()): ?> 
                        <option value ="<?= $fila['codtipd']; ?>" <?= ($fila['codtipd'] == $clientes["codtipd"]) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($fila['nomtipd']); ?>
                        </option>
                        <?php endwhile; ?>
                        <?php endif; ?>
                </select>
            </div>

            <div class="mb-3 col-6">
                <label for="selDis" class="form-label">Distrito:</label>
                <select class="form-select" id="selDis" name="selDis" required>
                    <option value="">Seleccione el Distrito </option>
                    <?php if (isset($distritos) && $distritos ->num_rows > 0): ?>
                        <?php while ($fila = $distritos -> fetch_assoc()): ?> 
                        <option value ="<?= $fila['coddis']; ?>" <?= ($fila['coddis'] == $clientes["coddis"]) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($fila['nomdis']); ?>
                        </option>
                        <?php endwhile; ?>
                        <?php endif; ?>
                </select>
            </div>

            <div class="mb-3 col-6">
                <label for="selSex" class="form-label">Sexo:</label>
                <select class="form-select" id="selSex" name="selSex" required>
                    <option value="">Seleccione el Sexo </option>
                    <?php if (isset($sexos) && $sexos ->num_rows > 0): ?>
                        <?php while ($fila = $sexos -> fetch_assoc()): ?> 
                        <option value ="<?= $fila['codsex']; ?>" <?= ($fila['codsex'] == $clientes["codsex"]) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($fila['nomsex']); ?>
                        </option>
                        <?php endwhile; ?>
                        <?php endif; ?>
                </select>
            </div>

            <div class="mb-3 col-6">
                <label for="chkEst" class="form-label">Estado:</label>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="chkEst" name="chkEst" <?= ($clientes['estcli'] == 1) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="chkEst">Habilitado</label>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="/ciberelectrica/public/?controller=cliente&action=listar" class="btn btn-dark">Regresar</a>
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