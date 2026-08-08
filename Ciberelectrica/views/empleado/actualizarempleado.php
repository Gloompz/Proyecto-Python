<!-- inicializando el valor de producto -->
<?php
$empleados = $empleados ?? [
    'codemp' => '',
    'nomemp' => '',
    'apepemp' => '',
    'apememp' => '',
    'docemp' => '',
    'fecemp' => date('Y-m-d'),
    'diremp' => '',
    'telemp' => '',
    'celemp' => '',
    'coremp' => '',
    'usuemp' => '',
    'claemp' => '',
    'sueemp' => '',
    'fecing' => date('Y-m-d'),
    'nomesp' => '',
    'estemp' => 0,
    'coddis' => '',
    'codsex' => '',
    'codrol' => '',
    'codtipd' => '',
    'codestc' => '',
    'codgrai' => ''
];
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CiberElectrik | Actualizar Empleado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- inicio del menu -->
        <?php include __DIR__ . '/../templates/menu.php'; ?>
        <!-- fin del menu -->

        <!-- inicio del contenido -->
        <div class="container body-content">

        <h1>Actualización de Empleado</h1>

        <!-- inicio del formulario -->
        <form action="/ciberelectrica/public/?controller=empleado&action=actualizar" method="post">

        <div class="row">
            <div class="mb-3 col-6">
                <label for="txtCod" class="form-label">Código:</label>
                <input type="text" class="form-control" id="txtCod" name="txtCod" readonly value="<?= $empleados['codemp']; ?>">
            </div>
            <div class="mb-3 col-6">
                <label for="txtNom" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="txtNom" name="txtNom" value="<?= htmlspecialchars($empleados['nomemp']); ?>" required>
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-6">
                <label for="txtApep" class="form-label">Apellido Paterno:</label>
                <input type="text" class="form-control" id="txtApep" name="txtApep" value="<?= htmlspecialchars($empleados['apepemp']); ?>" required>
            </div>
            <div class="mb-3 col-6">
                <label for="txtApem" class="form-label">Apellido Materno:</label>
                <input class="form-control" id="txtApem" name="txtApem" required><?= htmlspecialchars($empleados['apememp']); ?></textarea>
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-6">
                <label for="selTip" class="form-label">Tipo de Documento:</label>
                <select class="form-select" id="selTip" name="selTip" required>
                    <option value="">Seleccione el Tipo de Documento </option>
                    <?php if (isset($tiposdoc) && $tiposdoc ->num_rows > 0): ?>
                        <?php while ($fila = $tiposdoc -> fetch_assoc()): ?> 
                        <option value ="<?= $fila['codtipd']; ?>" <?= ($fila['codtipd'] == $empleados["codtipd"]) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($fila['nomtipd']); ?>
                        </option>
                        <?php endwhile; ?>
                        <?php endif; ?>
                </select>
            </div>
            <div class="mb-3 col-6">
                <label for="txtDoc" class="form-label">Numero de Documento:</label>
                <input type="text" class="form-control" id="txtDoc" name="txtDoc" value="<?= htmlspecialchars($empleados['docemp']); ?>" required>
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-6">
                <label for="txtFec" class="form-label">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" id="txtFec" name="txtFec" value="<?= $empleados['fecemp']; ?>" required>
            </div>
            <div class="mb-3 col-6">
                <label for="txtPre" class="form-label">Direccion:</label>
                <textarea class="form-control" id="txtDir" required> <?= htmlspecialchars($empleados['diremp']); ?></textarea>
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-6">
                <label for="selDis" class="form-label">Distrito:</label>
                <select class="form-select" id="selDis" name="selDis" required>
                    <option value="">Seleccione el Distrito </option>
                    <?php if (isset($distritos) && $distritos ->num_rows > 0): ?>
                        <?php while ($fila = $distritos -> fetch_assoc()): ?> 
                        <option value ="<?= $fila['coddis']; ?>" <?= ($fila['coddis'] == $empleados["coddis"]) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($fila['nomdis']); ?>
                        </option>
                        <?php endwhile; ?>
                        <?php endif; ?>
                </select>
            </div>
            <div class="mb-3 col-6">
                <label for="txtTel" class="form-label">Telefono:</label>
                <input type="number" class="form-control" id="txtTel" name="txtTel" value="<?= $empleados['telemp']; ?>" required>
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-6">
                <label for="txtCan" class="form-label">Celular:</label>
                <input type="number" class="form-control" id="txtCel" name="txtCan" value="<?= $empleados['celemp']; ?>" required>
            </div>
            <div class="mb-3 col-6">
                <label for="txtCan" class="form-label">Correo:</label>
                <input type="email" class="form-control" id="txtCan" name="txtCan" value="<?= $empleados['coremp']; ?>" required>
            </div>
        </div>

        <div class="row">
                <div class="mb-3 col-6">
                    <label for="txtUsu" class="form-label">Usuario:</label>
                    <input type="text" class="form-control" id="txtUsu" name="txtUsu"
                        value="<?= htmlspecialchars($empleados['usuemp']); ?>" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="txtCla" class="form-label">Clave:</label>
                    <input type="password" class="form-control" id="txtCla" name="txtCla"
                        value="<?= htmlspecialchars($empleados['claemp']); ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-6">
                    <label for="txtSue" class="form-label">Sueldo:</label>
                    <input type="number" step="0.01" class="form-control" id="txtSue" name="txtSue"
                        value="<?= $empleados['sueemp']; ?>" required>
                </div>
                <div class="mb-3 col-6">
                    <label for="txtFeci" class="form-label">Fecha de Ingreso:</label>
                    <input type="date" class="form-control" id="txtFeci" name="txtFeci"
                        value="<?= $empleados['fecing']; ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-6">
                    <label for="txtEsp" class="form-label">Nombre de Especialización:</label>
                    <input type="text" class="form-control" id="txtEsp" name="txtEsp"
                        value="<?= htmlspecialchars($empleados['nomesp']); ?>">
                </div>
                <div class="mb-3 col-6">
                    <label for="selRol" class="form-label">Rol:</label>
                    <select class="form-select" id="selRol" name="selRol" required>
                        <option value="">Seleccione un rol</option>
                        <?php if (isset($rol) && $rol->num_rows > 0): ?>
                            <?php while ($fila = $rol->fetch_assoc()): ?>
                                <option value="<?= $fila['codrol']; ?>"
                                    <?= ($fila['codrol'] == $empleados['codrol']) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($fila['nomrol']); ?>
                                </option>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-6">
                    <label for="selSex" class="form-label">Sexo:</label>
                    <select class="form-select" id="selSex" name="selSex" required>
                        <option value="">Seleccione el sexo</option>
                        <?php if (isset($sexos) && $sexos->num_rows > 0): ?>
                            <?php while ($fila = $sexos->fetch_assoc()): ?>
                                <option value="<?= $fila['codsex']; ?>"
                                    <?= ($fila['codsex'] == $empleados['codsex']) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($fila['nomsex']); ?>
                                </option>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="mb-3 col-6">
                    <label for="selEstc" class="form-label">Estado Civil:</label>
                    <select class="form-select" id="selEstc" name="selEstc" required>
                        <option value="">Seleccione el estado civil</option>
                        <?php if (isset($estadocivil) && $estadocivil->num_rows > 0): ?>
                            <?php while ($fila = $estadocivil->fetch_assoc()): ?>
                                <option value="<?= $fila['codestc']; ?>"
                                    <?= ($fila['codestc'] == $empleados['codestc']) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($fila['nomestc']); ?>
                                </option>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <div class="mb-3 col-6">
                <label for="selSex" class="form-label">Sexo:</label>
                <select class="form-select" id="selSex" name="selSex" required>
                    <option value="">Seleccione el Sexo </option>
                    <?php if (isset($sexos) && $sexos ->num_rows > 0): ?>
                        <?php while ($fila = $sexos -> fetch_assoc()): ?> 
                        <option value ="<?= $fila['codsex']; ?>" <?= ($fila['codsex'] == $empleados["codsex"]) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($fila['nomsex']); ?>
                        </option>
                        <?php endwhile; ?>
                        <?php endif; ?>
                </select>
            </div>

        <div class="row">
                <div class="mb-3 col-6">
                    <label for="selGra" class="form-label">Grado de Instrucción:</label>
                    <select class="form-select" id="selGra" name="selGra" required>
                        <option value="">Seleccione el grado de instrucción</option>
                        <?php if (isset($gradoinstruccion) && $gradoinstruccion->num_rows > 0): ?>
                            <?php while ($fila = $gradoinstruccion->fetch_assoc()): ?>
                                <option value="<?= $fila['codgrai']; ?>"
                                    <?= ($fila['codgrai'] == $empleados['codgrai']) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($fila['nomgrai']); ?>
                                </option>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="mb-3 col-6">
                    <label for="chkEst" class="form-label">Estado:</label>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="chkEst" name="chkEst"
                            <?= ($empleados['estemp'] == 1) ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="chkEst">Habilitado</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="/ciberelectrica/public/?controller=empleado&action=listar" class="btn btn-dark">Regresar</a>
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