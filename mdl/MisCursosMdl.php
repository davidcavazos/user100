<?php

class MisCursosMdl {
  private $driver;

  function __construct() {
    $this->driver = new mysqli('localhost', 'root', 'root', 'mudledb');
    if ($this->driver->connect_errno) {
      die('<br>Error en la conexion');
    }
  }

  function datos() {
    $query = 'SELECT * FROM curso';
    $r = $this->driver->query($query);
    $rows = array();
    while ($row = $r->fetch_assoc()) {
      $rows[] = $row;
    }
    return $rows;
  }
}

?>
