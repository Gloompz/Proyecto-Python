<?php

require_once __DIR__ . '/../models/Empleado.php';
require_once __DIR__ . '/../models/Rol.php';
require_once __DIR__ . '/../models/Sexo.php';
require_once __DIR__ . '/../models/Distrito.php';
require_once __DIR__ . '/../models/TipoDocumento.php';
require_once __DIR__ . '/../models/EstadoCivil.php';
require_once __DIR__ . '/../models/GradoInstruccion.php';

class EmpleadoController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new Empleado();
    }

    // Mostrar listado de productos habilitados con paginación
    public function listar()
    {
        $limite = 5;
        $pagina = isset($_GET['page']) ? (int) $_GET['page'] : 1;

        if ($pagina < 1) {
            $pagina = 1;
        }

        $inicio = ($pagina - 1) * $limite;
        $totalRegistros = $this->modelo->countAllCustom();
        $totalPaginas = ceil($totalRegistros / $limite);
        $empleados = $this->modelo->findAllCustomPaginated($inicio, $limite);

        require_once __DIR__ . '/../views/empleado/listarempleado.php';
    }

    // Mostrar formulario nuevo
    public function registro()
    {
        // Instanciamos los modelos de Marca y Categoria
        $distritoModel = new Distrito();
        $sexoModel = new Sexo();
        $rolModel = new Rol();
        $tipodocumentoModel = new tipodocumento();
        $estadocivilModel = new EstadoCivil();
        $gradoinstruccionModel = new GradoInstruccion();
        $distritos = $distritoModel->findAllCustom();
        $sexos = $sexoModel->findAllCustom();
        $rol = $rolModel->findAllCustom();
        $tiposdoc = $tipodocumentoModel->findAllCustom();
        $estadocivil = $estadocivilModel->findAllCustom();
        $gradoinstruccion = $gradoinstruccionModel->findAllCustom();

        require_once __DIR__ . '/../views/empleado/registrarempleado.php';
    }

    // Guardar producto
    public function registrar()
    {
        $nombre = $_POST['txtNom'] ?? '';
        $apellidopaterno = $_POST['txtApep'] ?? '';
        $apellidomaterno = $_POST['txtApem'] ?? '';
        $documento = $_POST['txtDoc'] ?? '';
        $fecha = $_POST['txtFec'] ?? date('Y-m-d');
        $direccion = $_POST['txtDir'] ?? '';
        $telefono = $_POST['txtTel'] ?? '';
        $celular = $_POST['txtCel'] ?? '';
        $correo = $_POST['txtCor'] ?? '';
        $usuario = $_POST['txtUsu'] ?? '';
        $clave = $_POST['txtCla'] ?? '';
        $sueldo = $_POST['txtSue'] ?? 0;
        $fechaingreso = $_POST['txtFeci'] ?? date('Y-m-d'); 
        $especialidad = $_POST['txtEsp'] ?? '';      
        $estado = isset($_POST['chkEst']) ? 1 : 0;
        $codigodistrito = $_POST['selDis'] ?? 0;
        $codigosexo = $_POST['selSex'] ?? 0;
        $codigorol = $_POST['selRol'] ?? 0;
        $codigotipodocumento = $_POST['selTip'] ?? 0;
        $codigoestadocivil = $_POST['selEstc'] ?? 0;
        $codigogradoinstruccion = $_POST['selGra'] ?? 0;
        $this->modelo->add($nombre, $apellidopaterno, $apellidomaterno, $documento, $fecha, $direccion, $telefono, $celular, $correo, $usuario, $clave, $sueldo, $fechaingreso, $especialidad, $estado,              $codigodistrito, $codigosexo, $codigorol, $codigotipodocumento, $codigoestadocivil, $codigogradoinstruccion);

        header('Location: /ciberelectrica/public/?controller=empleado&action=listar');
        exit;
    }

    // Mostrar formulario editar
    public function actualiza()
    {
        $id = $_GET['id'] ?? 0;
        $resultado = $this->modelo->findById($id);

        if ($resultado && $resultado->num_rows > 0) {
            $empleados = $resultado->fetch_assoc();

            // También cargamos marcas y categorías para los selects
            $distritoModel = new Distrito();
            $sexoModel = new Sexo();
            $rolModel = new Rol();
            $tipodocumentoModel = new tipodocumento();
            $estadocivilModel = new EstadoCivil();
            $gradoinstruccionModel = new GradoInstruccion();
            $distritos = $distritoModel->findAllCustom();
            $sexos = $sexoModel->findAllCustom();
            $rol = $rolModel->findAllCustom();
            $tiposdoc = $tipodocumentoModel->findAllCustom();
            $estadocivil = $estadocivilModel->findAllCustom();
            $gradoinstruccion = $gradoinstruccionModel->findAllCustom();

            require_once __DIR__ . '/../views/empleado/actualizarempleado.php';
        } else {
            echo "Empleado no encontrado";
        }
    }

    // Actualizar producto
    public function actualizar()
    {
        $id = $_POST['txtCod'] ?? 0;
        $nombre = $_POST['txtNom'] ?? '';
        $apellidopaterno = $_POST['txtApep'] ?? '';
        $apellidomaterno = $_POST['txtApem'] ?? '';
        $documento = $_POST['txtDoc'] ?? '';
        $fecha = $_POST['txtFec'] ?? date('Y-m-d');
        $direccion = $_POST['txtDir'] ?? '';
        $telefono = $_POST['txtTel'] ?? '';
        $celular = $_POST['txtCel'] ?? '';
        $correo = $_POST['txtCor'] ?? '';
        $usuario = $_POST['txtUsu'] ?? '';
        $clave = $_POST['txtCla'] ?? '';
        $sueldo = $_POST['txtSue'] ?? 0;
        $fechaingreso = $_POST['txtFeci'] ?? date('Y-m-d'); 
        $especialidad = $_POST['txtEsp'] ?? '';      
        $estado = isset($_POST['chkEst']) ? 1 : 0;
        $codigodistrito = $_POST['selDis'] ?? 0;
        $codigosexo = $_POST['selSex'] ?? 0;
        $codigorol = $_POST['selRol'] ?? 0;
        $codigotipodocumento = $_POST['selTip'] ?? 0;
        $codigoestadocivil = $_POST['selEstc'] ?? 0;
        $codigogradoinstruccion = $_POST['selGra'] ?? 0;

        $this->modelo->update($id, $nombre, $apellidopaterno, $apellidomaterno, $documento, $fecha, $direccion, $telefono, $celular, $correo, $usuario, $clave, $sueldo, $fechaingreso, $especialidad, $estado, $codigodistrito, $codigosexo, $codigorol, $codigotipodocumento, $codigoestadocivil, $codigogradoinstruccion);

        header('Location: /ciberelectrica/public/?controller=empleado&action=listar');
        exit;
    }

    // Eliminación lógica
    public function eliminar()
    {
        $id = $_GET['id'] ?? 0;
        $this->modelo->delete($id);

        header('Location: /ciberelectrica/public/?controller=empleado&action=listar');
        exit;
    }

    // Mostrar listado de habilitación de productos con paginación
    public function habilita()
    {
        $limite = 5;
        $pagina = isset($_GET['page']) ? (int) $_GET['page'] : 1;

        if ($pagina < 1) {
            $pagina = 1;
        }

        $inicio = ($pagina - 1) * $limite;
        $totalRegistros = $this->modelo->countAll();
        $totalPaginas = ceil($totalRegistros / $limite);
        $empleados = $this->modelo->findAllPaginated($inicio, $limite);

        require_once __DIR__ . '/../views/empleado/habilitarempleado.php';
    }

    // Habilitar producto
    public function habilitar()
    {
        $id = $_GET['id'] ?? 0;
        $this->modelo->enable($id);

        header('Location: /ciberelectrica/public/?controller=empleado&action=habilita');
        exit;
    }

    // Deshabilitar producto
    public function deshabilitar()
    {
        $id = $_GET['id'] ?? 0;
        $this->modelo->disable($id);

        header('Location: /ciberelectrica/public/?controller=empleado&action=habilita');
        exit;
    }

    // Login
    public function login()
    {
        $usuario = $_POST['txtUsu'] ?? '';
        $clave = $_POST['txtCla'] ?? '';


        // Validamos credenciales con el modelo
        $empleado = $this->modelo->login($usuario, $clave);


        if ($empleado) {
            // Si existe, iniciamos sesión
            session_start();
            $_SESSION['empleado'] = $empleado;


            // Redirigimos al menú principal
            header('Location: /ciberelectrica/public/?controller=empleado&action=menu');
            exit;
        } else {
            // Si no existe, mostramos mensaje de error
            $mensaje = "Usuario o clave incorrecta";
            require_once __DIR__ . '/../views/ingreso.php';
        }
    }


    // Menú principal
    public function menu()
    {
        require_once __DIR__ . '/../views/menuprincipal.php';
    }


    // Cerrar sesión
    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        $mensaje = null;
        require_once __DIR__ . '/../views/ingreso.php';
        exit;
    }

}

?>