<?php
require_once "./app/models/EquiposModel.php";
require_once "./app/views/EquiposView.php";
require_once "./app/views/ErrorView.php";

class EquiposController
{
  private $model;
  private $view;
  private $errorView;

  public function __construct()
  {
    $this->model = new EquiposModel();
    $this->view = new EquiposView();
    $this->errorView = new ErrorView();
  }
  public function usuarioEsAdministradorYEstaLogueado()
  {
    if ($_SESSION['ROL'] != 'ADMIN' || !isset($_SESSION['ID_USER'])) {
      return header('Location: ' . BASE_URL . 'inicioSesion');
    }
  }
  function moverArchivoADestino($directorioDestino, $nombreInput)
  {
    $nombreArchivo = basename($_FILES[$nombreInput]['name']);
    $ubicacionFinal = $directorioDestino . $nombreArchivo;

    if (move_uploaded_file($_FILES[$nombreInput]['tmp_name'], $ubicacionFinal)) {
      return $nombreArchivo; // Devolvemos el nombre para guardarlo en la DB
    } else {
      return false;
    }
  }
  public function mostrarInicio()
  {
    return $this->view->mostrarHome();
  }
  public function mostrarDuelo()
  {
    $equipo1 = $this->model->traerEquipoAlAzar();
    if (empty($equipo1)) {
      $this->errorView->mostrarErr("No hay ningun equipo en la tabla!");
      header("Location: " . BASE_URL);
      die();
    }
    $equipo2 = $this->model->traerEquipoAlAzar();
    while ($equipo1->id == $equipo2->id) {
      $equipo2 = $this->model->traerEquipoAlAzar();
    }

    return $this->view->mostrarDuelo($equipo1, $equipo2);
  }

  public function traerTodosLosEquipos()
  {
    $equipos = $this->model->traerEquipos();
    return $equipos;
  }
  public function traerEquipoPorId($id)
  {
    $equipo = $this->model->traerEquipo($id);
    return $equipo;
  }
  public function agregarEquipo()
  {
    $this->usuarioEsAdministradorYEstaLogueado();
    if (empty($_POST['nombre']) && empty($_POST['escudo']) && empty($_POST['imagen']) && empty($_POST['sonido'])) {
      $this->errorView->mostrarErr("Complete los campos!");
      header("Location: " . "admin");
      die();
    }

    if (isset($_FILES['escudo']) && isset($_FILES['imagen']) && isset($_FILES['sonido'])) {


      $nombreEscudo = $this->moverArchivoADestino('./img/escudos/', 'escudo');
      $nombreImagen = $this->moverArchivoADestino('./img/', 'imagen');
      $nombreSonido = $this->moverArchivoADestino('./sonidos/', 'sonido');
    }

    // 3. Tomamos el nombre del equipo por POST
    $nombreEquipo = $_POST['nombre'];

    // 4. Insertamos en la DB los nombres de los archivos que devolvió la función
    if ($nombreEscudo && $nombreImagen && $nombreSonido) {
      $lastInsertId = $this->model->insertarEquipo($nombreEquipo, $nombreEscudo, $nombreImagen, $nombreSonido);

      if ($lastInsertId) {
        header("Location: " . BASE_URL . "admin");
      }
    } else {
      echo "Error al subir uno de los archivos.";
    }
  }
  public function eliminarEquipo()
  {
    $this->usuarioEsAdministradorYEstaLogueado();
    if (empty($_POST['equipo'])) {
      $this->errorView->mostrarErr("Complete los campos!");
      die();
    }

    $id_equipo = $_POST['equipo'];
    $rowCount = $this->model->eliminarEquipo($id_equipo);
    if ($rowCount != NULL) {
      header("Location: " . BASE_URL . "admin");
    } else {
      echo "Error al eliminar uno de los archivos!";
    }
  }
  public function editarEquipo()
  {
    $this->usuarioEsAdministradorYEstaLogueado();
    if (empty($_POST['equipo'])) {
      $this->errorView->mostrarErr("Complete los campos!");
      die();
    }
  }
  public function registrarVoto($idGanador, $idPerdedor) {
    // 1. Sumamos el voto solo al ganador
    $this->model->sumarVoto($idGanador);

    // 2. Sumamos un duelo total a AMBOS (ganador y perdedor)
    $this->model->sumarDuelo($idGanador);
    $this->model->sumarDuelo($idPerdedor);

    // IMPORTANTE: Asegurate de que no haya ningún "echo" o "var_dump" arriba de esto
    echo json_encode(['status' => 200, 'msg' => 'Duelo y voto procesados correctamente']);
}

  public function resetearDuelosVotos(){
    $this->usuarioEsAdministradorYEstaLogueado();
    $this->model->resetearDuelosVotos();
    return header("Location: " . BASE_URL . "ranking");
  }

  public function mostrarRanking(){
    $equipos = $this->traerTodosLosEquipos();
    if(empty($equipos)){

    }
    return $this->view->mostrarRanking($equipos);
  }
}
