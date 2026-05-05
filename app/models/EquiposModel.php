<?php

class EquiposModel
{
  private $db;

  public function __construct()
  {
    $this->db = new PDO('mysql:host=localhost;dbname=db_hinchadas;charset=utf8', 'root', '');
  }
  public function traerEquipoAlAzar()
  {
    $stmt = $this->db->query('SELECT COUNT(*) FROM equipos');
    $totalFilas = $stmt->fetchColumn();
    $numeroAlAzar = random_int(1, $totalFilas);
    $query = $this->db->prepare('SELECT * FROM equipos WHERE id = ?');
    $query->execute([$numeroAlAzar]);
    $equipo = $query->fetch(PDO::FETCH_OBJ);
    return $equipo;
  }
  public function traerEquipos()
  {
    $query = $this->db->prepare('SELECT * FROM equipos');
    $query->execute();
    $equipos = $query->fetchAll(PDO::FETCH_OBJ);
    return $equipos;
  }

  public function traerEquipo($id)
  {
    $query = $this->db->prepare('SELECT * FROM equipos WHERE id = ?');
    $query->execute([$id]);
    $equipo = $query->fetch(PDO::FETCH_OBJ);
    return $equipo;
  }
  public function insertarEquipo($nombre, $escudo, $imagen, $sonido)
  {
    $query = $this->db->prepare('INSERT INTO equipos(nombre, escudo, imagen, sonido) VALUES (?,?,?,?)');
    $query->execute([$nombre, $escudo, $imagen, $sonido]);
    return $this->db->lastInsertId();
  }
  public function eliminarEquipo($id)
  {

    $query = $this->db->prepare('DELETE FROM equipos WHERE id = ?');
    $query->execute([$id]);
    return $query->rowCount();
  }
  public function sumarVoto($id){
    $query = $this->db->prepare('UPDATE equipos SET votos = votos + 1 WHERE id = ?');
    $query->execute([$id]);
    return $query->rowCount();
  }
  public function sumarDuelo($id){
    $query = $this->db->prepare('UPDATE equipos SET duelos_totales = duelos_totales + 1 WHERE id = ?');
    $query->execute([$id]);
    return $query->rowCount();
  }
  public function resetearDuelosVotos(){
    $query = $this->db->prepare('UPDATE equipos SET votos = 0, duelos_totales = 0');
    $query->execute();
    return $query->rowCount();
  }
}
