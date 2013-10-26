<?php

require_once('ctl/BaseCtl.php');
class MisCursosCtl extends BaseCtl {
  public function ejecutar() {
    $this->mostrar();

    switch (htmlspecialchars($_GET['act'])) {
      case 'display':
      default:
    }
  }

  public function generarBody() {
    // Ciclo
    require_once('mdl/CiclosMdl.php');
    $mdl = new CiclosMdl();

    $body = file_get_contents($this->vstFile);

    $inicio_fila = strrpos($body, '<option>{CICLO}');
    $final_fila = $inicio_fila + 24;
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

    $inicio_fila = strrpos($body, '<option>{CURSO}');
    $final_fila = $inicio_fila + 24;
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

    // Alumnos
    require_once('mdl/UsuariosMdl.php');
    $mdl = new UsuariosMdl();

    $inicio_fila = strrpos($body, '<tr>');
    $final_fila = strrpos($body, '</tr>') + 5;
    $fila = substr($body, $inicio_fila, $final_fila - $inicio_fila);

    $datos = $mdl->datos('SELECT * FROM usuario ORDER BY codigo');
    $filas = '';
    $num = 1;
    foreach ($datos as $row) {
      if ($row['activo'] === 'false') {
        continue;
      }
      $new_fila = $fila;
      $dict = array(
        '{X}' => $num,
        '{CODIGO}' => $row['codigo'],
        '{NOMBRE}' => $row['apellidos'] . ', ' . $row['nombres'],
        '{CARRERA}' => $row['carrera'],
        '{TOTAL}' => '0'
      );
      $num += 1;
      $new_fila = strtr($new_fila, $dict);
      $filas .= $new_fila;
    }
    $body = str_replace($fila, $filas, $body);

    return $body;
  }
}

?>
