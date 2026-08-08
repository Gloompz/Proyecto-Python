<?php

require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Marca.php';
require_once __DIR__ . '/../models/Categoria.php';

class ProductoController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new Producto();
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
        $productos = $this->modelo->findAllCustomPaginated($inicio, $limite);

        require_once __DIR__ . '/../views/producto/listarproducto.php';
    }

    // Mostrar formulario nuevo
    public function registro()
    {
        // Instanciamos los modelos de Marca y Categoria
        $marcaModel = new Marca();
        $categoriaModel = new Categoria();
        $marcas = $marcaModel->findAllCustom();     // solo habilitadas
        $categorias = $categoriaModel->findAllCustom();

        require_once __DIR__ . '/../views/producto/registrarproducto.php';
    }

    // Guardar producto
    public function registrar()
    {
        $nombre = $_POST['txtNom'] ?? '';
        $descripcion = $_POST['txtDes'] ?? '';
        $fechaIngreso = $_POST['txtFec'] ?? date('Y-m-d');
        $precio = $_POST['txtPre'] ?? 0;
        $cantidad = $_POST['txtCan'] ?? 0;
        $estado = isset($_POST['chkEst']) ? 1 : 0;
        $codigoMarca = $_POST['selMar'] ?? 0;
        $codigoCategoria = $_POST['selCat'] ?? 0;

        $this->modelo->add($nombre, $descripcion, $fechaIngreso, $precio, $cantidad, $estado, $codigoMarca, $codigoCategoria);

        header('Location: /ciberelectrica/public/?controller=producto&action=listar');
        exit;
    }

    // Mostrar formulario editar
    public function actualiza()
    {
        $id = $_GET['id'] ?? 0;
        $resultado = $this->modelo->findById($id);

        if ($resultado && $resultado->num_rows > 0) {
            $producto = $resultado->fetch_assoc();

            // También cargamos marcas y categorías para los selects
            $marcaModel = new Marca();
            $categoriaModel = new Categoria();
            $marcas = $marcaModel->findAllCustom();
            $categorias = $categoriaModel->findAllCustom();

            require_once __DIR__ . '/../views/producto/actualizarproducto.php';
        } else {
            echo "Producto no encontrado";
        }
    }

    // Actualizar producto
    public function actualizar()
    {
        $id = $_POST['txtCod'] ?? 0;
        $nombre = $_POST['txtNom'] ?? '';
        $descripcion = $_POST['txtDes'] ?? '';
        $fechaIngreso = $_POST['txtFec'] ?? date('Y-m-d');
        $precio = $_POST['txtPre'] ?? 0;
        $cantidad = $_POST['txtCan'] ?? 0;
        $estado = isset($_POST['chkEst']) ? 1 : 0;
        $codigoMarca = $_POST['selMar'] ?? 0;
        $codigoCategoria = $_POST['selCat'] ?? 0;

        $this->modelo->update($id, $nombre, $descripcion, $fechaIngreso, $precio, $cantidad, $estado, $codigoMarca, $codigoCategoria);

        header('Location: /ciberelectrica/public/?controller=producto&action=listar');
        exit;
    }

    // Eliminación lógica
    public function eliminar()
    {
        $id = $_GET['id'] ?? 0;
        $this->modelo->delete($id);

        header('Location: /ciberelectrica/public/?controller=producto&action=listar');
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
        $productos = $this->modelo->findAllPaginated($inicio, $limite);

        require_once __DIR__ . '/../views/producto/habilitarproducto.php';
    }

    // Habilitar producto
    public function habilitar()
    {
        $id = $_GET['id'] ?? 0;
        $this->modelo->enable($id);

        header('Location: /ciberelectrica/public/?controller=producto&action=habilita');
        exit;
    }

    // Deshabilitar producto
    public function deshabilitar()
    {
        $id = $_GET['id'] ?? 0;
        $this->modelo->disable($id);

        header('Location: /ciberelectrica/public/?controller=producto&action=habilita');
        exit;
    }

    // Menú principal
    public function menu()
    {
        require_once __DIR__ . '/../views/menuprincipal.php';
    }
}

?>