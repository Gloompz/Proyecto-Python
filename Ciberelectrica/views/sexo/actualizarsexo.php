<!-- inicializando el valor de distrito -->
<?php
$sexo = $sexo ?? [
    'codsex' => '',
    'nomsex' => '',
    'estsex' => 0
];
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CiberElectrik | Actualizar Sexo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"rel="stylesheet"integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"crossorigin="anonymous">
</head>
<body>
<div class="container">

 <!-- inicio del menu -->
        <?php include __DIR__ . '/../templates/menu.php'; ?>
        <!-- fin del menu -->

        <!-- inicio del contenido -->
        <div class="container body-content">

    <h1>Actualizacion de Sexo</h1>
    <!-- inicio del formulario -->
    <form action="/ciberelectrica/public/?controller=sexo&action=actualizar" method="post">
        <div class="col-6">
            <label for="txtCod" class="form-label">Codigo:</label>
            <input type="text" class="form-control" id="txtCod" name="txtCod" readonly
                value="<?= $sexo['codsex']; ?>">
        </div>
        <div class="col-6">
            <label for="txtNom" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="txtNom" name="txtNom"
                value="<?= htmlspecialchars($sexo['nomsex']); ?>">
        </div>
        <div class="col-6">
            <label for="chkEst" class="form-label">Estado:</label>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="chkEst" name="chkEst"
                        <?= ($sexo['estsex'] == 1) ? 'checked' : ''; ?>>
                <label class="form-check-label" for="chkEst">Habilitado</label>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="/ciberelectrica/public/?controller=sexo&action=listar" class="btn btn-dark">Regresar</a>
    </form>
    <!-- fin del formulario -->

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