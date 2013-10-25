<?php

class BaseMdl {
  protected $driver;

  function __construct() {
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
