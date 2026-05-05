<?php

class ErrorView
{
  public function mostrarErr($msj)
  {
    echo $msj;
  }
  public function mostrarErrNotFound($msj)
  {
    require_once "./app/views/layouts/header.phtml";
    require_once "./app/views/templates/error.phtml";
    require_once "./app/views/layouts/footer.phtml";
  }
}
