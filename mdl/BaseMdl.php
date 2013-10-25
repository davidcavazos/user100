<?php

class BaseMdl {
  private $driver;

  function __construct() {
    $this->driver = new mysqli('localhost', 'root', 'root', 'mudledb');
    if ($this->driver->connect_errno) {
      die('<br>Error en la conexion');
    }
  }

  function datos($table) {
    $query = "SELECT * FROM $table";
    $r = $this->driver->query($query);
    $rows = array();
    while ($row = $r->fetch_assoc()) {
      $rows[] = $row;
    }
    return $rows;
  }
}

?>
