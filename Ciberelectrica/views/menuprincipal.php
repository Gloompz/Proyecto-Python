<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CiberElectrik | Menu Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container {
            display: flex;
            flex-direction: column;
            flex: 1;
        }
        .body-content {
            flex: 1;
        }
        footer {
            background-color: #212529;
            color: #FFFFFF;
            text-align: center;
            padding: 5px 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container body">
        <!-- inicio del menu -->
            <?php include __DIR__ . '/templates/menu.php'; ?>
        <!-- fin del menu -->


        <div class="mb-3"></div>


        <!-- inicio del contenido -->
        <div class="container body-content">
            <h1>Bienvenidos al Sistema Web de Ventas de CiberElectrik</h1>
        </div>
        <!-- findel contenido -->
    <!-- inicio del footer -->
            <?php include __DIR__ . '/templates/pie.php'; ?>
        <!-- fin del footer -->
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
