<?php
// obtener el controlador y la accion
$controller = isset($_GET['controller']) ? strtolower($_GET['controller']) : 'inicio';
$action = isset($_GET['action']) ? strtolower($_GET['action']) : 'index';

switch ($controller) {
    // inicio
    case 'inicio':
        require_once __DIR__ . '/../controllers/InicioController.php';
        $objController = new InicioController();
        switch ($action) {
            // Vista ingreso
            case 'index':
                $objController->Index();
                break;
            // Menú principal
            case 'menu':
                $objController->MenuPrincipal();
                break;
            default:
                echo "Acción no encontrada";
                break;
        }
        break;

    // distrito
    case 'distrito':
        require_once __DIR__ . '/../controllers/DistritoController.php';
        $objController = new DistritoController();
        switch ($action) {
            // Listar
            case 'listar':
                $objController->listar();
                break;
            // Mostrar formulario nuevo
            case 'registro':
                $objController->registro();
                break;
            // Guardar
            case 'registrar':
                $objController->registrar();
                break;
            // Mostrar formulario editar
            case 'actualiza':
                $objController->actualiza();
                break;
            // Actualizar
            case 'actualizar':
                $objController->actualizar();
                break;
            // Eliminar lógico
            case 'eliminar':
                $objController->eliminar();
                break;
            // Habilita
            case 'habilita':
                $objController->habilita();
                break;
            // Habilitar
            case 'habilitar':
                $objController->habilitar();
                break;
            // Deshabilitar
            case 'deshabilitar':
                $objController->deshabilitar();
                break;
            // Menu
            case 'menu':
                $objController->menu();
                break;
            default:
                echo "Acción no encontrada";
                break;
        }
        break;


        // tipodocumento
    case 'tipodocumento':
        require_once __DIR__ . '/../controllers/TipoDocumentoController.php';
        $objController = new TipoDocumentoController();
        switch ($action) {
            // Listar
            case 'listar':
                $objController->listar();
                break;
            // Mostrar formulario nuevo
            case 'registro':
                $objController->registro();
                break;
            // Guardar
            case 'registrar':
                $objController->registrar();
                break;
            // Mostrar formulario editar
            case 'actualiza':
                $objController->actualiza();
                break;
            // Actualizar
            case 'actualizar':
                $objController->actualizar();
                break;
            // Eliminar lógico
            case 'eliminar':
                $objController->eliminar();
                break;
            // Habilita
            case 'habilita':
                $objController->habilita();
                break;
            // Habilitar
            case 'habilitar':
                $objController->habilitar();
                break;
            // Deshabilitar
            case 'deshabilitar':
                $objController->deshabilitar();
                break;
            // Menu
            case 'menu':
                $objController->menu();
                break;
            default:
                echo "Acción no encontrada";
                break;
        }
        break;

        // marca
    case 'marca':
        require_once __DIR__ . '/../controllers/MarcaController.php';
        $objController = new MarcaController();
        switch ($action) {
            // Listar
            case 'listar':
                $objController->listar();
                break;
            // Mostrar formulario nuevo
            case 'registro':
                $objController->registro();
                break;
            // Guardar
            case 'registrar':
                $objController->registrar();
                break;
            // Mostrar formulario editar
            case 'actualiza':
                $objController->actualiza();
                break;
            // Actualizar
            case 'actualizar':
                $objController->actualizar();
                break;
            // Eliminar lógico
            case 'eliminar':
                $objController->eliminar();
                break;
            // Habilita
            case 'habilita':
                $objController->habilita();
                break;
            // Habilitar
            case 'habilitar':
                $objController->habilitar();
                break;
            // Deshabilitar
            case 'deshabilitar':
                $objController->deshabilitar();
                break;
            // Menu
            case 'menu':
                $objController->menu();
                break;
            default:
                echo "Acción no encontrada";
                break;
        }
        break;

        // sexo
    case 'sexo':
        require_once __DIR__ . '/../controllers/SexoController.php';
        $objController = new SexoController();
        switch ($action) {
            // Listar
            case 'listar':
                $objController->listar();
                break;
            // Mostrar formulario nuevo
            case 'registro':
                $objController->registro();
                break;
            // Guardar
            case 'registrar':
                $objController->registrar();
                break;
            // Mostrar formulario editar
            case 'actualiza':
                $objController->actualiza();
                break;
            // Actualizar
            case 'actualizar':
                $objController->actualizar();
                break;
            // Eliminar lógico
            case 'eliminar':
                $objController->eliminar();
                break;
            // Habilita
            case 'habilita':
                $objController->habilita();
                break;
            // Habilitar
            case 'habilitar':
                $objController->habilitar();
                break;
            // Deshabilitar
            case 'deshabilitar':
                $objController->deshabilitar();
                break;
            // Menu
            case 'menu':
                $objController->menu();
                break;
            default:
                echo "Acción no encontrada";
                break;
        }
        break;

        // gradoinstruccion
    case 'gradoinstruccion':
        require_once __DIR__ . '/../controllers/GradoInstruccionController.php';
        $objController = new GradoInstruccionController();
        switch ($action) {
            // Listar
            case 'listar':
                $objController->listar();
                break;
            // Mostrar formulario nuevo
            case 'registro':
                $objController->registro();
                break;
            // Guardar
            case 'registrar':
                $objController->registrar();
                break;
            // Mostrar formulario editar
            case 'actualiza':
                $objController->actualiza();
                break;
            // Actualizar
            case 'actualizar':
                $objController->actualizar();
                break;
            // Eliminar lógico
            case 'eliminar':
                $objController->eliminar();
                break;
            // Habilita
            case 'habilita':
                $objController->habilita();
                break;
            // Habilitar
            case 'habilitar':
                $objController->habilitar();
                break;
            // Deshabilitar
            case 'deshabilitar':
                $objController->deshabilitar();
                break;
            // Menu
            case 'menu':
                $objController->menu();
                break;
            default:
                echo "Acción no encontrada";
                break;
        }
        break;

        // estadocivil
    case 'estadocivil':
        require_once __DIR__ . '/../controllers/EstadoCivilController.php';
        $objController = new EstadoCivilController();
        switch ($action) {
            // Listar
            case 'listar':
                $objController->listar();
                break;
            // Mostrar formulario nuevo
            case 'registro':
                $objController->registro();
                break;
            // Guardar
            case 'registrar':
                $objController->registrar();
                break;
            // Mostrar formulario editar
            case 'actualiza':
                $objController->actualiza();
                break;
            // Actualizar
            case 'actualizar':
                $objController->actualizar();
                break;
            // Eliminar lógico
            case 'eliminar':
                $objController->eliminar();
                break;
            // Habilita
            case 'habilita':
                $objController->habilita();
                break;
            // Habilitar
            case 'habilitar':
                $objController->habilitar();
                break;
            // Deshabilitar
            case 'deshabilitar':
                $objController->deshabilitar();
                break;
            // Menu
            case 'menu':
                $objController->menu();
                break;
            default:
                echo "Acción no encontrada";
                break;
        }
        break;

        // rol
    case 'rol':
        require_once __DIR__ . '/../controllers/RolController.php';
        $objController = new RolController();
        switch ($action) {
            // Listar
            case 'listar':
                $objController->listar();
                break;
            // Mostrar formulario nuevo
            case 'registro':
                $objController->registro();
                break;
            // Guardar
            case 'registrar':
                $objController->registrar();
                break;
            // Mostrar formulario editar
            case 'actualiza':
                $objController->actualiza();
                break;
            // Actualizar
            case 'actualizar':
                $objController->actualizar();
                break;
            // Eliminar lógico
            case 'eliminar':
                $objController->eliminar();
                break;
            // Habilita
            case 'habilita':
                $objController->habilita();
                break;
            // Habilitar
            case 'habilitar':
                $objController->habilitar();
                break;
            // Deshabilitar
            case 'deshabilitar':
                $objController->deshabilitar();
                break;
            // Menu
            case 'menu':
                $objController->menu();
                break;
            default:
                echo "Acción no encontrada";
                break;
        }
        break;

        // categoria
    case 'categoria':
        require_once __DIR__ . '/../controllers/CategoriaController.php';
        $objController = new CategoriaController();
        switch ($action) {
            // Listar
            case 'listar':
                $objController->listar();
                break;
            // Mostrar formulario nuevo
            case 'registro':
                $objController->registro();
                break;
            // Guardar
            case 'registrar':
                $objController->registrar();
                break;
            // Mostrar formulario editar
            case 'actualiza':
                $objController->actualiza();
                break;
            // Actualizar
            case 'actualizar':
                $objController->actualizar();
                break;
            // Eliminar lógico
            case 'eliminar':
                $objController->eliminar();
                break;
            // Habilita
            case 'habilita':
                $objController->habilita();
                break;
            // Habilitar
            case 'habilitar':
                $objController->habilitar();
                break;
            // Deshabilitar
            case 'deshabilitar':
                $objController->deshabilitar();
                break;
            // Menu
            case 'menu':
                $objController->menu();
                break;
            default:
                echo "Acción no encontrada";
                break;
        }
        break;

        // producto
        case 'producto':
            require_once __DIR__ . '/../controllers/ProductoController.php';
            $objController = new ProductoController();
            switch ($action) {
                case 'listar':
                    $objController->listar();
                    break;
                case 'registro':
                    $objController->registro();
                    break;
                case 'registrar':
                    $objController->registrar();
                    break;
                case 'actualiza':
                    $objController->actualiza();
                    break;
                case 'actualizar':
                    $objController->actualizar();
                    break;
                case 'eliminar':
                    $objController->eliminar();
                    break;
                case 'habilita':
                    $objController->habilita();
                    break;
                case 'habilitar':
                    $objController->habilitar();
                    break;
                case 'deshabilitar':
                    $objController->deshabilitar();
                    break;
                case 'menu':
                    $objController->menu();
                    break;
                default:
                    echo "Acción no encontrada";
                    break;
        }
        break; 

        // producto
        case 'cliente':
            require_once __DIR__ . '/../controllers/ClienteController.php';
            $objController = new ClienteController();
            switch ($action) {
                case 'listar':
                    $objController->listar();
                    break;
                case 'registro':
                    $objController->registro();
                    break;
                case 'registrar':
                    $objController->registrar();
                    break;
                case 'actualiza':
                    $objController->actualiza();
                    break;
                case 'actualizar':
                    $objController->actualizar();
                    break;
                case 'eliminar':
                    $objController->eliminar();
                    break;
                case 'habilita':
                    $objController->habilita();
                    break;
                case 'habilitar':
                    $objController->habilitar();
                    break;
                case 'deshabilitar':
                    $objController->deshabilitar();
                    break;
                case 'menu':
                    $objController->menu();
                    break;
                case 'buscar':
                    $objController->buscar();
                    break;
                default:
                    echo "Acción no encontrada";
                    break;
        }
        break;

        // empleado
    case 'empleado':
        require_once __DIR__ . '/../controllers/EmpleadoController.php';
        $objController = new EmpleadoController();
        switch ($action) {
            case 'listar':
                $objController->listar();
                break;
            case 'registro':
                $objController->registro();
                break;
            case 'registrar':
                $objController->registrar();
                break;
            case 'actualiza':
                $objController->actualiza();
                break;
            case 'actualizar':
                $objController->actualizar();
                break;
            case 'eliminar':
                $objController->eliminar();
                break;
            case 'habilita':
                $objController->habilita();
                break;
            case 'habilitar':
                $objController->habilitar();
                break;
            case 'deshabilitar':
                $objController->deshabilitar();
                break;
            case 'login':
                $objController->login();
                break;
            case 'menu':
                $objController->menu();
                break;
            case 'logout':
                $objController->logout();
                break;
            default:
                echo "Acción no encontrada";
                break;
        }
        break;

        // ticketpedido
        case 'ticketpedido':
            require_once __DIR__ . '/../controllers/TicketPedidoController.php';
            $objController = new TicketPedidoController();
            switch ($action) {
                case 'listar':
                    $objController->listar();
                    break;
                case 'detalle':
                    $objController->detalle();
                    break;
                case 'anular':
                    $objController->anular();
                    break;
                case 'habilitar':
                    $objController->habilitar();
                    break;
                case 'registro':
                    $objController->registro();
                    break;
                case 'registrar':     // <--- AGREGAR ESTO
                    $objController->registrar();
                    break;
                default:
                    echo "Acción no encontrada";
                    break;
        }
        break;

    default:
        echo "Controlador no encontrado";
        break;
}
?>