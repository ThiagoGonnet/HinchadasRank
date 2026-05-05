<?php
require_once "./app/models/UsuariosModel.php";
require_once "./app/views/UsuariosView.php";
require_once "./app/views/ErrorView.php";

class UsuariosController
{
  private $model;
  private $view;
  private $errorView;
  private $equiposController;

  public function __construct()
  {
    $this->model = new UsuariosModel();
    $this->view = new UsuariosView();
    $this->errorView = new ErrorView();
    $this->equiposController = new EquiposController();
  }
  public function usuarioLogueado()
  {
    if (!isset($_SESSION['ID_USER'])) {
      return header('Location: ' . BASE_URL . 'inicioSesion');
    }
  }
  public function usuarioEsAdministrador()
  {
    if ($_SESSION['ROL'] != 'ADMIN') {
      return header('Location: ' . BASE_URL . 'home');
    }
  }

  public function mostrarFormRegistro()
  {
    $equipos = $this->equiposController->traerTodosLosEquipos();
    return $this->view->mostrarFormRegistro($equipos);
  }
  public function registrarUsuario()
  {
    if (empty($_POST['correo']) && empty($_POST['contraseña']) && empty($_POST['equipo']) && empty($_POST['usuario'])) {
      echo "Complete los campos!";
      die();
    }

    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];
    $contraseñaHash = password_hash($contraseña, PASSWORD_DEFAULT);
    $equipo = $_POST['equipo'];
    $usuario = $_POST['usuario'];

    $this->model->crearUsuario($usuario, $correo, $contraseñaHash, $equipo);
    header("Location: " . BASE_URL . "perfil");
  }
  public function mostrarPerfil()
  {
    $this->usuarioLogueado();
    $usuario_id = $_SESSION['ID_USER'];

    $usuario = $this->model->traerUsuarioPorId($usuario_id);
    $equipo = $this->equiposController->traerEquipoPorId($usuario->id_equipo);


    return $this->view->mostrarPerfil($usuario, $equipo);
  }

  public function mostrarPanelAdministracion()
  {
    $this->usuarioLogueado();
    $this->usuarioEsAdministrador();
    $equipos = $this->equiposController->traerTodosLosEquipos();
    return $this->view->mostrarPanelAdministracion($equipos);
  }
}
