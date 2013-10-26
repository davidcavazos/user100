<?php

require_once('ctl/BaseCtl.php');
class CiclosCtl extends BaseCtl {
  public function ejecutar() {
    if (isset($_GET['alta'])) {
      require_once('mdl/CiclosMdl.php');
      $mdl = new CiclosMdl();
      $ciclo = $_POST['ciclo'];
      $fecha_inicio = $_POST['fecha_inicio'];
      $fecha_fin = $_POST['fecha_fin'];
      $r = $mdl->alta($ciclo, $fecha_inicio, $fecha_fin);
    }
    $this->mostrar();
  }

  public function generarBody() {
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

    // Llenar campos
    if (count($datos) > 0) {
      $body = $this->campo('ciclo', $datos[0]['ciclo'], $body);
      $body = $this->campo('fecha_inicio', $datos[0]['fecha_inicio'], $body);
      $body = $this->campo('fecha_fin', $datos[0]['fecha_fin'], $body);
    }

    return $body;
  }
}

?>
