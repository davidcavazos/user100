<?php

require_once('ctl/BaseCtl.php');
class MisCursosCtl extends BaseCtl {
  public function ejecutar() {
    if (isset($_GET['alta'])) {
      require_once('mdl/CursosMdl.php');
      $mdl = new CursosMdl();
    }
    $this->mostrar();
  }

  public function generarBody() {
    // Ciclo
    require_once('mdl/CiclosMdl.php');
    $mdl = new CiclosMdl();

    $body = file_get_contents($this->vstFile);

    $inicio_fila = strrpos($body, '<option value="{CICLO}">');
    $final_fila = $inicio_fila + 40;
    $fila = substr($body, $inicio_fila, $final_fila - $inicio_fila);

    $datos = $mdl->datos('SELECT * FROM ciclo_escolar ORDER BY ciclo DESC');
    $filas = '';
    foreach ($datos as $row) {
      $new_fila = $fila;
      $dict = array(
        '{CICLO}' => $row['ciclo'],
      );
      $new_fila = strtr($new_fila, $dict);
      $filas .= $new_fila;
    }
    $body = str_replace($fila, $filas, $body);

    // Curso
    require_once('mdl/CursosMdl.php');
    $mdl = new CursosMdl();

    $inicio_fila = strrpos($body, '<option value="{CURSO}">');
    $final_fila = $inicio_fila + 40;
    $fila = substr($body, $inicio_fila, $final_fila - $inicio_fila);

    $datos = $mdl->datos('SELECT * FROM curso ORDER BY nombre_materia');
    $filas = '';
    foreach ($datos as $row) {
      $new_fila = $fila;
      $dict = array(
        '{CURSO}' => $row['nrc'] . ' - ' . $row['nombre_materia'],
      );
      $new_fila = strtr($new_fila, $dict);
      $filas .= $new_fila;
    }
    $body = str_replace($fila, $filas, $body);

    // Llenar campos
    if (count($datos) > 0) {
      $body = $this->campo('nrc', $datos[0]['nrc'], $body);
      $body = $this->campo('materia', $datos[0]['nombre_materia'], $body);
      $body = $this->campo('seccion', $datos[0]['seccion'], $body);
    }

    $this->onload_fcn = 'on_load()';
    return $body;
  }
}

?>
