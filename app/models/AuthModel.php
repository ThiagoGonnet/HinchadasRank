<?php

class AuthModel
{
  private $db;

  public function __construct()
  {
    $this->db = new PDO('mysql:host=localhost;dbname=db_hinchadas;charset=utf8', 'root', '');
  }
  public function obtenerUsuario($correo)
  {
    $query = $this->db->prepare('SELECT * FROM usuarios WHERE correo = ?');
    $query->execute([$correo]);
    $usuario = $query->fetch(PDO::FETCH_OBJ);
    return $usuario;
  }
}
