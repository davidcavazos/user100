<?php

class BaseMdl {
  protected $driver;

  function __construct() {
    //$this->driver = new mysqli('148.202.152.110', 'cc409_user100', 'IDRfhfim5k', 'cc409_user100');
    $this->driver = new mysqli('127.0.0.1', 'root', 'root', 'mudledb');
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
