<?php

require_once('ctl/BaseCtl.php');
class MisCursosCtl extends BaseCtl {
  public function ejecutar() {
    $this->mostrar();

    require_once($this->mdlFile);
    $mdl = new $this->mdlClass();
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

    $datos = $mdl->datos('usuario');
    $filas = '';
    foreach ($datos as $row) {
      $new_fila = $fila;
      $dict = array(
        '{X}' => '<input type="checkbox">',
        '{LISTA}' => $row['lista'],
        '{CODIGO}' => $row['codigo'],
        '{NOMBRE}' => $row['apellidos'] . ', ' . $row['nombres'],
        '{CARRERA}' => $row['carrera'],
        '{TOTAL}' => '0'
      );
      $new_fila = strtr($new_fila, $dict);
      $filas .= $new_fila;
    }
    return str_replace($fila, $filas, $body);
  }
}

?>
