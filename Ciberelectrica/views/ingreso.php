<!doctype html>
<html lang="es">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CiberElectrik | Ingreso al Sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        body {
            background: linear-gradient(to bottom, #7431F9, #FFFFFF);
        }


        .card-header {
            background-color: #4B0082;
            color: #fff;
        }


        .card-footer {
            background-color: #222;
            color: #FFFFFF;
            font-size: 0.9rem;
        }
    </style>
</head>


<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <!-- inicio del card -->
        <div class="card rounded-3 shadow-lg" style="max-width: 400px;">
            <div class="card-header text-center">
                <h1>Ingreso al Sistema</h1>
            </div>
            <div class="card-body">
                <!-- mensaje de error -->
                <?php if (!empty($mensaje)): ?>
                    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                        <?= $mensaje ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                <?php endif; ?>


                <!-- inicio del formulario -->
                <form method="post" action="/ciberelectrica/public/?controller=empleado&action=login">


                    <div class="mb-3">
                        <label for="txtUsu" class="form-label">Usuario:</label>
                        <input type="text" class="form-control" id="txtUsu" name="txtUsu"
                            placeholder="Ingresa el usuario" required>
                    </div>
                    <div class="mb-3">
                        <label for="txtCla" class="form-label">Clave</label>
                        <input type="password" class="form-control" id="txtCla" name="txtCla"
                            placeholder="Ingresa la clave" required>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary w-100">Ingresar</button>
                    </div>


                </form>
                <!-- fin del formulario -->
            </div>
            <div class="card-footer text-center">
                Desarrollado por <strong>CiberElectrik</strong>
            </div>
        </div>
        <!-- fin del card -->




    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y"
        crossorigin="anonymous"></script>
</body>


</html>
