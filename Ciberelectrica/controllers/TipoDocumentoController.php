<?php
require_once __DIR__ . '/../models/TipoDocumento.php';

class TipoDocumentoController
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new TipoDocumento();
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
        $totalRegistros = $this->modelo->countAllCustom();
        $totalPaginas = ceil($totalRegistros / $limite);
        $tipodocumento = $this->modelo->findAllCustomPaginated($inicio, $limite);
        require_once __DIR__ . '/../views/tipodocumento/listartipodocumento.php';
    }

    // Mostrar formulario nuevo
    public function registro()
    {
        require_once __DIR__ . '/../views/tipodocumento/registrartipodocumento.php';
    }

    // Guardar distrito
    public function registrar()
    {
        $nombre = $_POST['txtNom'] ?? '';
        $estado = isset($_POST['chkEst']) ? 1 : 0;
        $this->modelo->add($nombre, $estado);
        header('Location: /ciberelectrica/public/?controller=tipodocumento&action=listar');
        exit;
    }

    // Mostrar formulario editar
    public function actualiza()
    {
        $id = $_GET['id'] ?? 0;
        $resultado = $this->modelo->findById($id);
        if ($resultado && $resultado->num_rows > 0) {
            $tipodocumento = $resultado->fetch_assoc();
            require_once __DIR__ . '/../views/tipodocumento/actualizartipodocumento.php';
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
        header('Location: /ciberelectrica/public/?controller=tipodocumento&action=listar');
        exit;
    }

    // Eliminación lógica
    public function eliminar()
    {
        $id = $_GET['id'] ?? 0;
        $this->modelo->delete($id);
        header('Location: /ciberelectrica/public/?controller=tipodocumento&action=listar');
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
        $tipodocumento = $this->modelo->findAllPaginated($inicio, $limite);
        require_once __DIR__ . '/../views/tipodocumento/habilitartipodocumento.php';
    }

    // Habilitar distrito
    public function habilitar()
    {
        $id = $_GET['id'] ?? 0;
        $this->modelo->enable($id);
        header('Location: /ciberelectrica/public/?controller=tipodocumento&action=habilita');
        exit;
    }

    // Deshabilitar distrito
    public function deshabilitar()
    {
        $id = $_GET['id'] ?? 0;
        $this->modelo->disable($id);
        header('Location: /ciberelectrica/public/?controller=tipodocumento&action=habilita');
        exit;
    }

    // Mostrar menu principal
    public function menu()
    {
        require_once __DIR__ . '/../views/menuprincipal.php';
    }
}
?>