<?php
require_once "./app/models/AuthModel.php";
require_once "./app/views/AuthView.php";
require_once "./app/views/ErrorView.php";

class AuthController
{
  private $view;
  private $model;
  private $errorView;

  public function __construct()
  {
    $this->view = new AuthView();
    $this->model = new AuthModel();
    $this->errorView = new errorView();
  }
  public function mostrarFormInicioSesion()
  {
    return $this->view->mostrarFormInicioSesion();
  }

  public function iniciarSesion()
  {
    if (empty($_POST['contraseña']) && empty($_POST['correo'])) {
      echo "Complete los campos!";
      die();
    }

    $contraseña = $_POST['contraseña'];
    $correo = $_POST['correo'];


    $user = $this->model->obtenerUsuario($correo);

    if (!empty($user) && password_verify($contraseña, $user->contraseña)) {
      session_start();
      $_SESSION['ID_USER'] = $user->id;
      $_SESSION['USERNAME'] = $user->nombre;
      $_SESSION['ROL'] = $user->rol;

      if ($_SESSION['ROL'] === 'ADMIN') {
        header("Location: " . BASE_URL . "admin");
      } else {
        header("Location: " . BASE_URL . "perfil");
      }
      die();
    } else {
      return $this->view->mostrarFormInicioSesion("Usuario o contraseña incorrectos");
    }
  }

  public function cerrarSesion()
  {
    // 2. Limpiamos todas las variables de la sesión en el servidor
    session_unset();

    // 3. Destruimos la sesión
    session_destroy();

    // 4. Redireccionamos al home o al login (fundamental)
    header("Location: " . BASE_URL . "home");
    die();
  }
}
