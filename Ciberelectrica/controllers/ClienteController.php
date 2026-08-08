    <?php

    require_once __DIR__ . '/../models/Cliente.php';
    require_once __DIR__ . '/../models/Sexo.php';
    require_once __DIR__ . '/../models/Distrito.php';
    require_once __DIR__ . '/../models/TipoDocumento.php';

    class ClienteController
    {
        private $modelo;

        public function __construct()
        {
            $this->modelo = new Cliente();
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
            $clientes = $this->modelo->findAllCustomPaginated($inicio, $limite);

            require_once __DIR__ . '/../views/cliente/listarcliente.php';
        }

        // Mostrar formulario nuevo
        public function registro()
        {
            // Instanciamos los modelos de Marca y Categoria
            $distritoModel = new Distrito();
            $sexoModel = new Sexo();
            $tipodocumentoModel = new tipodocumento();
            $distritos = $distritoModel->findAllCustom();     // solo habilitadas
            $sexos = $sexoModel->findAllCustom();
            $tiposdoc = $tipodocumentoModel->findAllCustom();

            require_once __DIR__ . '/../views/cliente/registrarcliente.php';
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
            $estado = isset($_POST['chkEst']) ? 1 : 0;
            $codigodistrito = $_POST['selDis'] ?? 0;
            $codigosexo = $_POST['selSex'] ?? 0;
            $codigotipodocumento = $_POST['selTip'] ?? 0;

            $this->modelo->add($nombre, $apellidopaterno, $apellidomaterno, $documento, $fecha, $direccion, $telefono, $celular, $correo, $estado, $codigodistrito, $codigosexo, $codigotipodocumento);

            header('Location: /ciberelectrica/public/?controller=cliente&action=listar');
            exit;
        }


        // Buscar clientes
        public function buscar()
        {
            $termino = $_GET['termino'] ?? '';
            
            if (strlen($termino) > 0) {
                $clientes = $this->modelo->buscarPorNombre($termino);
            } else {
                $clientes = [];
            }
            
            // Devolver como JSON para usar con fetch / AJAX
            header('Content-Type: application/json');
            
            $data = [];
            if ($clientes && $clientes->num_rows > 0) {
                while ($fila = $clientes->fetch_assoc()) {
                    $data[] = [
                        'codcli' => $fila['codcli'],
                        'nombre' => $fila['nomcli'] . ' ' . $fila['apepcli'] . ' ' . ($fila['apemcli'] ?? ''),
                        'doccli' => $fila['doccli'],
                        'celcli' => $fila['celcli']
                    ];
                }
            }
            
            echo json_encode($data);
            exit;
        }

        // Mostrar formulario editar
        public function actualiza()
        {
            $id = $_GET['id'] ?? 0;
            $resultado = $this->modelo->findById($id);

            if ($resultado && $resultado->num_rows > 0) {
                $clientes = $resultado->fetch_assoc();

                // También cargamos marcas y categorías para los selects
                $distritoModel = new Distrito();
                $sexoModel = new Sexo();
                $tipodocumentoModel = new tipodocumento();
                $distritos = $distritoModel->findAllCustom();
                $sexos = $sexoModel->findAllCustom();
                $tiposdoc = $tipodocumentoModel->findAllCustom();

                require_once __DIR__ . '/../views/cliente/actualizarcliente.php';
            } else {
                echo "Cliente no encontrado";
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
            $estado = isset($_POST['chkEst']) ? 1 : 0;
            $codigodistrito = $_POST['selDis'] ?? 0;
            $codigosexo = $_POST['selSex'] ?? 0;
            $codigotipodocumento = $_POST['selTip'] ?? 0;

            $this->modelo->update($id, $nombre, $apellidopaterno, $apellidomaterno, $documento, $fecha, $direccion, $telefono, $celular, $correo, $estado, $codigodistrito, $codigosexo, $codigotipodocumento);

            header('Location: /ciberelectrica/public/?controller=cliente&action=listar');
            exit;
        }

        // Eliminación lógica
        public function eliminar()
        {
            $id = $_GET['id'] ?? 0;
            $this->modelo->delete($id);

            header('Location: /ciberelectrica/public/?controller=cliente&action=listar');
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
            $clientes = $this->modelo->findAllPaginated($inicio, $limite);

            require_once __DIR__ . '/../views/cliente/habilitarcliente.php';
        }

        // Habilitar producto
        public function habilitar()
        {
            $id = $_GET['id'] ?? 0;
            $this->modelo->enable($id);

            header('Location: /ciberelectrica/public/?controller=cliente&action=habilita');
            exit;
        }

        // Deshabilitar producto
        public function deshabilitar()
        {
            $id = $_GET['id'] ?? 0;
            $this->modelo->disable($id);

            header('Location: /ciberelectrica/public/?controller=cliente&action=habilita');
            exit;
        }

        // Menú principal
        public function menu()
        {
            require_once __DIR__ . '/../views/menuprincipal.php';
        }
    }

    ?>