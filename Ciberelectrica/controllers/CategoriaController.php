<?php
require_once __DIR__ . '/../models/Categoria.php';

class CategoriaController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new Categoria();
    }

    // Mostrar listado de distritos
    public function listar()
    {
    $limite = 10;
    $pagina = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    if ($pagina < 1) {
        $pagina = 1;
    }
    $inicio = ($pagina - 1) * $limite;
    $totalRegistros = $this->modelo->countAllCustom();  // ← Solo habilitadas
    $totalPaginas = ceil($totalRegistros / $limite);
    $categoria = $this->modelo->findAllCustomPaginated($inicio, $limite);  // ← Ahora ordena por código
    require_once __DIR__ . '/../views/categoria/listarcategoria.php';
    }

    // Mostrar formulario nuevo
    public function registro()
    {
        require_once __DIR__ . '/../views/categoria/registrarcategoria.php';
    }

    // Guardar distrito
    public function registrar()
    {
        $nombre = $_POST['txtNom'] ?? '';
        $estado = isset($_POST['chkEst']) ? 1 : 0;
        $this->modelo->add($nombre, $estado);
        header('Location: /ciberelectrica/public/?controller=categoria&action=listar');
        exit;
    }

    // Mostrar formulario editar
    public function actualiza()
    {
        $id = $_GET['id'] ?? 0;
        $resultado = $this->modelo->findById($id);
        if ($resultado && $resultado->num_rows > 0) {
            $categoria = $resultado->fetch_assoc();
            require_once __DIR__ . '/../views/categoria/actualizarcategoria.php';
        } else {
            echo "Tipo de Documento no encontrado";
        }
    }

    // Actualizar distrito
    public function actualizar()
    {
        $id = $_POST['txtCod'] ?? 0;
        $nombre = $_POST['txtNom'] ?? '';
        $estado = isset($_POST['chkEst']) ? 1 : 0;
        $this->modelo->update($id, $nombre, $estado);
        header('Location: /ciberelectrica/public/?controller=categoria&action=listar');
        exit;
    }

    // Eliminación lógica
    public function eliminar()
    {
        $id = $_GET['id'] ?? 0;
        $this->modelo->delete($id);
        header('Location: /ciberelectrica/public/?controller=categoria&action=listar');
        exit;
    }

    // Mostrar listado de habilitacion distritos
    public function habilita()
    {
        $limite = 10;
        $pagina = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        if ($pagina < 1) {
            $pagina = 1;
        }
        $inicio = ($pagina - 1) * $limite;
        $totalRegistros = $this->modelo->countAll();
        $totalPaginas = ceil($totalRegistros / $limite);
        $categoria = $this->modelo->findAllPaginated($inicio, $limite);
        require_once __DIR__ . '/../views/categoria/habilitarcategoria.php';
    }

    // Habilitar distrito
    public function habilitar()
    {
        $id = $_GET['id'] ?? 0;
        $this->modelo->enable($id);
        header('Location: /ciberelectrica/public/?controller=categoria&action=habilita');
        exit;
    }

    // Deshabilitar distrito
    public function deshabilitar()
    {
        $id = $_GET['id'] ?? 0;
        $this->modelo->disable($id);
        header('Location: /ciberelectrica/public/?controller=categoria&action=habilita');
        exit;
    }

    // Mostrar menu principal
    public function menu()
    {
        require_once __DIR__ . '/../views/menuprincipal.php';
    }
}
?>