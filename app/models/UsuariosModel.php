<?php

class UsuariosModel
{
  private $db;

  public function __construct()
  {
    $this->db = new PDO('mysql:host=localhost;dbname=db_hinchadas;charset=utf8', 'root', '');
  }
  public function traerUsuarioPorId($id)
  {
    $query = $this->db->prepare('SELECT * FROM usuarios WHERE id = ?');
    $query->execute([$id]);
    $usuario = $query->fetch(PDO::FETCH_OBJ);
    return $usuario;
  }
  public function crearUsuario($usuario, $correo, $contraseña, $equipo)
  {
    $query = $this->db->prepare('INSERT INTO usuarios (usuario, correo, contraseña, id_equipo) VALUES (?,?,?,?)');
    $query->execute([$usuario, $correo, $contraseña, $equipo]);
    return $this->db->lastInsertId();
  }
}
