<?php

require_once('ctl/BaseCtl.php');
class EvaluacionCtl extends BaseCtl {
  public function ejecutar() {
    require_once('mdl/UsuariosMdl.php');
    $mdl = new UsuariosMdl();
    if (isset($_POST['get_alumnos'])) {
      $q = $mdl->datos("SELECT codigo, apellidos, nombres FROM usuario WHERE tipo_usuario=2");
      if (count($q) == 0) {
        echo 'Error: no se encontro';
        return;
      }
      $info = array();
      foreach ($q as $a) {
        $info[] = $a['apellidos'].', '.$a['nombres'].' ('.$a['codigo'].')';
      }
      echo json_encode($info);
    } else {
      $this->mostrar();
    }
  }

  public function generarBody() {
    $body = file_get_contents($this->vstFile);

    // Ciclo
    require_once('mdl/CiclosMdl.php');
    $mdl = new CiclosMdl();

    $inicio_fila = strrpos($body, '<option value="{CICLO}">');
    $final_fila = $inicio_fila + 40;
    $fila = substr($body, $inicio_fila, $final_fila - $inicio_fila);

    $datos = $mdl->datos('SELECT * FROM ciclo_escolar ORDER BY ciclo DESC');
    $ciclo='';
    if (!empty($datos)) {
      $ciclo = $datos[0]['ciclo'];
    }
    if (isset($_GET['ciclo'])) {
      $ciclo = $_GET['ciclo'];
    }

    $filas = '';
    foreach ($datos as $row) {
      $new_fila = $fila;
      $dict = array(
        '{CICLO}' => $row['ciclo'],
      );
      $new_fila = strtr($new_fila, $dict);
      if ($row['ciclo'] == $ciclo) {
        $new_fila = strtr($new_fila, array('>' => ' selected>'));
      }
      $filas .= $new_fila;
    }
    $body = str_replace($fila, $filas, $body);

    // Curso
    require_once('mdl/CursosMdl.php');
    $mdl = new CursosMdl();

    $inicio_fila = strrpos($body, '<option value="{CURSO}">');
    $final_fila = $inicio_fila + 40;
    $fila = substr($body, $inicio_fila, $final_fila - $inicio_fila);

    $datos = $mdl->datos("SELECT * FROM curso INNER JOIN materia WHERE clave_materia=clave AND ciclo='$ciclo' ORDER BY clave, seccion");
    if (!empty($datos)) {
      $clave = $datos[0]['clave'];
      $nrc = $datos[0]['nrc'];
    }
    if (isset($_GET['clave'])) {
      $clave = $_GET['clave'];
    }
    if (isset($_GET['nrc'])) {
      $nrc = $_GET['nrc'];
    }

    $filas = '';
    foreach ($datos as $row) {
      $new_fila = $fila;
      $dict = array(
        '{CURSO}' => $row['clave'].' - '.$row['materia'].' ('.$row['seccion'].') ['.$row['nrc'].']',
      );
      $new_fila = strtr($new_fila, $dict);
      if ($row['clave'] == $clave) {
        $new_fila = strtr($new_fila, array('>' => ' selected>'));
                }
      $filas .= $new_fila;
    }
    $body = str_replace($fila, $filas, $body);

    // Alumnos
    require_once('mdl/UsuariosMdl.php');
    $mdl = new UsuariosMdl();

    $inicio_fila = strrpos($body, '<tr>');
    $final_fila = strrpos($body, '</tr>') + 5;
    $fila = substr($body, $inicio_fila, $final_fila - $inicio_fila);

    $datos = $mdl->datos("SELECT * FROM usuario WHERE tipo_usuario=2 AND codigo IN( SELECT codigo FROM grupo WHERE ciclonrc='".$ciclo.$nrc."') AND tipo_usuario>0 ORDER BY apellidos");
    $filas = '';
    $num = 1;
    foreach ($datos as $row) {
      if ($row['activo'] == 0) {
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

      if ($this->tipo == 2) {
        $start = strrpos($fila, "<!--B{-->");
        $end = strrpos($fila, "<!--}B-->") + 9;
        $control = substr($fila, $start, $end - $start);
        $new_fila = str_replace($control, '', $fila);
      }

      $num += 1;
      $new_fila = strtr($new_fila, $dict);
      $filas .= $new_fila;
    }
    $body = str_replace($fila, $filas, $body);

    if ($this->tipo == 2) {
      $start = strrpos($body, '<!--A{-->');
      $end = strrpos($body, '<!--}A-->') + 9;
      $control = substr($body, $start, $end - $start);
      $body = str_replace($control, '', $body);

      $start = strrpos($body, '<!--C{-->');
      $end = strrpos($body, '<!--}C-->') + 9;
      $control = substr($body, $start, $end - $start);
      $body = str_replace($control, '', $body);
    }

    $this->onload_fcn = 'on_load()';
    return $body;
  }
}

?>
