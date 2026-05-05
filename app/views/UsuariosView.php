<?php

class UsuariosView
{
  public function mostrarFormRegistro($equipos)
  {
    require_once "./app/views/layouts/header.phtml";
    require_once "./app/views/templates/form-registro.phtml";
    require_once "./app/views/layouts/footer.phtml";
  }
  public function mostrarPerfil($usuario, $equipo)
  {
    require_once "./app/views/layouts/header.phtml";
    require_once "./app/views/templates/perfil.phtml";
    require_once "./app/views/layouts/footer.phtml";
  }

  public function mostrarPanelAdministracion($equipos)
  {
    require_once "./app/views/layouts/header.phtml";
    require_once "./app/views/templates/panel-adm.phtml";
    require_once "./app/views/layouts/footer.phtml";
  }
}
