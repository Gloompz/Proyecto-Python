<!-- iniciamos la sesion -->
<?php
session_start();
?>
<!-- fin de la sesion -->


<!-- agregamos los estilos globales -->
<style>
  html,
  body {
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
<!-- fin de los estilos globales -->


<!-- inicio de la barra de menu -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">CiberElectrik</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>


    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
<li class="nav-item"><a class="nav-link active" href="#">Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Quienes Somos</a></li>


        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Mantenimiento Simple</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/ciberelectrica/public/?controller=distrito&action=listar">Distrito</a></li>
            <li><a class="dropdown-item" href="/ciberelectrica/public/?controller=categoria&action=listar">Categoria</a></li>
            <li><a class="dropdown-item" href="/ciberelectrica/public/?controller=estadocivil&action=listar">Estado Civil</a></li>
            <li><a class="dropdown-item" href="/ciberelectrica/public/?controller=gradoinstruccion&action=listar">Grado Instrucción</a></li>
            <li><a class="dropdown-item" href="/ciberelectrica/public/?controller=marca&action=listar">Marca</a></li>
            <li><a class="dropdown-item" href="/ciberelectrica/public/?controller=rol&action=listar">Rol</a></li>
            <li><a class="dropdown-item" href="/ciberelectrica/public/?controller=sexo&action=listar">Sexo</a></li>
            <li><a class="dropdown-item" href="/ciberelectrica/public/?controller=tipodocumento&action=listar">Tipo de Documento</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Mantenimiento Cruzado</a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="/ciberelectrica/public/?controller=cliente&action=listar">Cliente</a></li>
          <li><a class="dropdown-item" href="/ciberelectrica/public/?controller=empleado&action=listar">Empleado</a></li>
          <li><a class="dropdown-item" href="/ciberelectrica/public/?controller=producto&action=listar">Producto</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Proceso</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/ciberelectrica/public/?controller=ticketpedido&action=listar">Ticket de Pedido</a></li>
          </ul>
        </li>


        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Cuenta</a>
          <ul class="dropdown-menu">
            <?php if (isset($_SESSION['empleado'])): ?>
              <li><a class="dropdown-item">Empleado: <?= $_SESSION['empleado']['nomemp'] . ' ' . $_SESSION['empleado']['apepemp']; ?></a></li>
              <li><a class="dropdown-item">Usuario: <?= $_SESSION['empleado']['usuemp']; ?></a></li>
              <li><a class="dropdown-item">Rol: <?= $_SESSION['empleado']['nomrol']; ?></a></li>
              <li><a class="dropdown-item" href="/ciberelectrica/public/?controller=empleado&action=logout">Cerrar Sesión</a></li>
            <?php endif; ?>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- fin de la barra de menu -->
