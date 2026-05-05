<?php

class AuthView
{
  public function mostrarFormInicioSesion($error = null)
  {
    require_once "./app/views/layouts/header.phtml";
    require_once "./app/views/templates/form-login.phtml";
    require_once "./app/views/layouts/footer.phtml";
  }
}
