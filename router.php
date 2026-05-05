<?php
// require once controllers
require_once "./app/controllers/EquiposController.php";
require_once "./app/controllers/UsuariosController.php";
require_once "./app/controllers/AuthController.php";
require_once "./app/views/ErrorView.php";

session_start();

// tag base
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');


$action = "home";

if (!empty($_GET['action'])) {
  $action = $_GET['action'];
}
$params = explode('/', $action);

switch ($params[0]) {
  case 'home':
    $controller = new EquiposController();
    $controller->mostrarInicio();
    break;
  case 'duelo':
    $controller = new EquiposController();
    $controller->mostrarDuelo();
    break;
  case 'ranking':
    $controller = new EquiposController();
    $controller->mostrarRanking();
    break;
  case 'votar':
    $idGanador = $params[1];
    $idPerdedor = $params[2]; // Capturamos el segundo ID
    $controller = new EquiposController();
    $controller->registrarVoto($idGanador, $idPerdedor);
    break;
  case 'admin':
    $controller = new UsuariosController();
    $controller->mostrarPanelAdministracion();
    break;
  case 'agregarEquipo':
    $controller = new EquiposController();
    $controller->agregarEquipo();
    break;
  case 'eliminarEquipo':
    $controller = new EquiposController();
    $id = $params[1];
    if (empty($id)) {
      $errorView = new ErrorView();
      $errorView->mostrarErr("Elija un equipo valido!");
      die();
    }
    $controller->eliminarEquipo($id);
    break;
  case 'editarEquipo':
    $controller = new EquiposController();
    $id = $_POST['equipo'];
    if (empty($id)) {
      $errorView = new ErrorView();
      $errorView->mostrarErr("Elija un equipo valido!");
      die();
    }
    $controller->editarEquipo($id);
    break;
  case 'resetearDuelosVotos':
    $controller = new EquiposController();
    $controller->resetearDuelosVotos();
    break;
  case 'formRegistro':
    $controller = new UsuariosController();
    $controller->mostrarFormRegistro();
    break;
  // LOGIN
  case 'inicioSesion':
    $controller = new AuthController();
    $controller->mostrarFormInicioSesion();
    break;
  case 'registrar':
    $controller = new UsuariosController();
    $controller->registrarUsuario();
    break;
  // DO_LOGIN
  case 'iniciarSesion':
    $controller = new AuthController();
    $controller->iniciarSesion();
    break;
  // LOGOUT
  case 'cerrarSesion':
    $controller = new AuthController();
    $controller->cerrarSesion();
    break;
  case 'perfil':
    $controller = new UsuariosController();
    $controller->mostrarPerfil();
    break;
  default:
    $view = new ErrorView();
    $view->mostrarErrNotFound("Error 404");
}
