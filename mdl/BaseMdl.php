<?php

class BaseMdl {
  protected $codigo;
  protected $tipo;
  protected $driver;

  public function __construct() {
    if (isset($_SESSION['tipo'])) {
      $this->tipo = $_SESSION['tipo'];
    }
    if (isset($_SESSION['codigo'])) {
      $this->codigo = $_SESSION['codigo'];
    }
    //$this->driver = new mysqli('148.202.152.110', 'cc409_user100', 'IDRfhfim5k', 'cc409_user100');
    $this->driver = new mysqli('localhost', 'root', 'root', 'mudledb');
    if ($this->driver->connect_errno) {
      die('Error: ' . $this->driver->connect_error);
    }
  }

  public function datos($query) {
    $r = $this->driver->query($query);
    $rows = array();
    while ($row = $r->fetch_assoc()) {
      $rows[] = $row;
    }
    $r->free();
    return $rows;
  }

  public function get_ciclos() {
    return $this->datos('SELECT * FROM ciclo_escolar ORDER BY ciclo DESC');
  }

  public function get_cursos($ciclo) {
    $filtro = '';
    if ($this->tipo == 1) {
      $filtro = "AND codigo_profesor='$this->codigo'";
    } elseif ($this->tipo == 2) {
      $filtro = "AND ciclonrc IN (SELECT ciclonrc FROM grupo WHERE codigo='$this->codigo')";
    }
    return $this->datos("SELECT * FROM curso INNER JOIN materia WHERE clave_materia=clave AND ciclo='$ciclo' $filtro ORDER BY clave, seccion");
  }

  public function get_alumnos_en_curso($ciclo, $nrc) {
    return $this->datos("SELECT * FROM usuario WHERE tipo_usuario=2 AND codigo IN (SELECT codigo FROM grupo WHERE ciclonrc='$ciclo$nrc') AND tipo_usuario>0 ORDER BY apellidos");
  }
}

?>
