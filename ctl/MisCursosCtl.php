<?php

require_once('ctl/BaseCtl.php');
class MisCursosCtl extends BaseCtl {
  public function ejecutar() {
    require_once('mdl/CursosMdl.php');
    $mdl = new CursosMdl();
    if (isset($_POST['llenar_curso'])) {
      $ciclo = $_POST['ciclo'];
      $curso = $_POST['curso'];
      $q = $mdl->datos("SELECT * FROM curso")[0];
      $info = array();
      $info['nrc'] = $q['nrc'];
      $info['materia'] = $q['nombre_materia'];
      $info['seccion'] = $q['seccion'];
      echo json_encode($info);
    } else {
      $this->mostrar();
    }
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

    $this->onload_fcn = 'on_load()';
    return $body;
  }
}

?>
