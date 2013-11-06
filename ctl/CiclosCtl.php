<?php

require_once('ctl/BaseCtl.php');
class CiclosCtl extends BaseCtl {
  public function ejecutar() {
    require_once('mdl/CiclosMdl.php');
    $mdl = new CiclosMdl();
    if (isset($_POST['llenar_ciclo'])) {
      $ciclo = $_POST['llenar_ciclo'];
      $q = $mdl->datos("SELECT * FROM ciclo_escolar WHERE ciclo='$ciclo'")[0];
      $info = array();
      $info['ciclo'] = $q['ciclo'];
      $info['fecha_inicio'] = $q['fecha_inicio'];
      $info['fecha_fin'] = $q['fecha_fin'];
      $q = $mdl->datos("SELECT * FROM detalle_ciclo_escolar WHERE ciclo='$ciclo'");
      $info['dia_no_efectivo'] = array();
      $info['descripcion'] = array();
      foreach ($q as $dia) {
        $info['dia_no_efectivo'][] = $dia['dia_no_efectivo'];
        $info['descripcion'][] = $dia['descripcion'];
      }
      echo json_encode($info);
    } elseif (isset($_POST['guardar'])) {
      $ciclo = $_POST['ciclo'];
      $new_ciclo = $_POST['new_ciclo'];
      $fecha_inicio = $_POST['fecha_inicio'];
      $fecha_fin = $_POST['fecha_fin'];
      $dias_festivo = $_POST['diafestivo'];
      $descripciones = $_POST['descripciondia'];
      $mdl->modificar($ciclo, $new_ciclo, $fecha_inicio, $fecha_fin,
                      $dias_festivo, $descripciones);
    } elseif (isset($_POST['agregar'])) {
      $ciclo = $_POST['ciclo'];
      $fecha_inicio = $_POST['fecha_inicio'];
      $fecha_fin = $_POST['fecha_fin'];
      $dia_festivo = $_POST['diafestivo'];
      $descripcion = $_POST['descripciondia'];
      $mdl->agregar($ciclo, $fecha_inicio, $fecha_fin, $dia_festivo, $descripcion);
    } else {
      $this->mostrar();
    }
  }

  public function generarBody() {
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

    $this->onload_fcn = 'on_load()';
    return $body;
  }
}

?>
