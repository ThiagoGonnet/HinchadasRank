<?php

class EquiposView{
  public function mostrarHome(){
    require_once "./app/views/layouts/header.phtml";
    require_once "./app/views/templates/home.phtml";
    require_once "./app/views/layouts/footer.phtml";
  }

  public function mostrarDuelo($equipo1, $equipo2){
    require_once "./app/views/layouts/header.phtml";
    require_once "./app/views/templates/duelo.phtml";
    require_once "./app/views/layouts/footer.phtml";
  }
  public function mostrarRanking($equipos){
    require_once "./app/views/layouts/header.phtml";
    require_once "./app/views/templates/ranking.phtml";
    require_once "./app/views/layouts/footer.phtml";
  }
}
