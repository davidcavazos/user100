<?php

class BaseMdl {
  protected $tipo;
  protected $driver;

  function __construct() {
    if (isset($_SESSION['tipo'])) {
      $this->tipo = $_SESSION['tipo'];
    }
    //$this->driver = new mysqli('148.202.152.110', 'cc409_user100', 'IDRfhfim5k', 'cc409_user100');
    $this->driver = new mysqli('localhost', 'root', 'root', 'mudledb');
    if ($this->driver->connect_errno) {
      die('Error: ' . $this->driver->connect_error);
    }
  }

  function datos($query) {
    $r = $this->driver->query($query);
    $rows = array();
    while ($row = $r->fetch_assoc()) {
      $rows[] = $row;
    }
    $r->free();
    return $rows;
  }

}

?>
