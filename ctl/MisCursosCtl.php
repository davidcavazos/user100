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
    require_once('mdl/UsuariosMdl.php');
    $mdl = new UsuariosMdl();

    $body = file_get_contents($this->vstFile);

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
    return str_replace($fila, $filas, $body);
  }
}

?>
