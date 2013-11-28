<?php

require_once('ctl/BaseCtl.php');
class MisCursosCtl extends BaseCtl {
  public function ejecutar() {
    require_once('mdl/CursosMdl.php');
    $mdl = new CursosMdl();
    if (isset($_POST['llenar_curso'])) {
      $ciclo = $_POST['ciclo'];
      $clave = $_POST['clave'];
      $q = $mdl->datos("SELECT * FROM curso INNER JOIN materia WHERE clave='$clave'")[0];
      $info = array();
      $info['clave_materia'] = $q['clave'];
      $info['academia'] = $q['academia'];
      $info['materia'] = $q['materia'];
      $info['nrc'] = $q['nrc'];
      $info['seccion'] = $q['seccion'];
      $q = $mdl->datos("SELECT * FROM detalle_curso");
      $info['dia'] = array();
      $info['horas_por_dia'] = array();
      $info['horario'] = array();
      foreach ($q as $dia) {
        $info['dia'][] = $dia['dia'];
        $info['horas_por_dia'][] = $dia['horas_por_dia'];
        $info['horario'][] = $dia['horario'];
      }
      echo json_encode($info);
    } elseif (isset($_POST['llenar_materia'])) {
      $clave = $_POST['clave'];
      $q = $mdl->datos("SELECT * FROM materia WHERE clave='$clave'")[0];
      $info = array();
      $info['materia'] = $q['materia'];
      $info['academia'] = $q['academia'];
      echo json_encode($info);
    } elseif (isset($_POST['guardar'])) {
      $nrc = $_POST['nrc'];
      $new_nrc = $_POST['new_nrc'];
      $ciclo = $_POST['ciclo'];
      $materia = $_POST['clave_materia'];
      $seccion = $_POST['seccion'];
      $academia = $_POST['academia'];
      $dias = $_POST['dia'];
      $horas_por_dia = $_POST['horas_por_dia'];
      $horarios = $_POST['horario'];
      $mdl->modificar($nrc, $new_nrc, $ciclo, $materia, $seccion, $academia,
                      $dias, $horas_por_dia, $horarios);
    }
    elseif(isset($_POST['guardar']))
    {
      $ciclo=$_POST['ciclo'];
      $clave=$_POST['clave'];
      $nrc=$_POST['nrc'];
      $seccion=$_POST['seccion'];
      $dia=$_POST['dia'];
      $hora=$_POST['hora'];
      $duracion=$_POST['duracion'];
      $mdl->insertar($ciclo, $clave, $nrc, $seccion, $dia, $hora, $duracion);
    }
    else {
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
    if (!empty($ciclo)) {
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

    // New Ciclo
    $inicio_fila = strrpos($body, '<option value="{NEWCICLO}">');
    $final_fila = $inicio_fila + 43;
    $fila = substr($body, $inicio_fila, $final_fila - $inicio_fila);

    $datos = $mdl->datos('SELECT * FROM ciclo_escolar ORDER BY ciclo DESC');
    $filas = '';
    foreach ($datos as $row) {
      $new_fila = $fila;
      $dict = array(
        '{NEWCICLO}' => $row['ciclo'],
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

    $datos = $mdl->datos("SELECT * FROM curso INNER JOIN materia WHERE clave_materia=clave AND ciclo='$ciclo' ORDER BY clave, seccion");
    if (!empty($datos)) {
      $clave = $datos[0]['clave'];
    }
    if (isset($_GET['clave'])) {
      $clave = $_GET['clave'];
    }

    $filas = '';
    foreach ($datos as $row) {
      $new_fila = $fila;
      $dict = array(
        '{CURSO}' => $row['clave'].' - '.$row['materia'].' ('.$row['seccion'].')',
      );
      $new_fila = strtr($new_fila, $dict);
      if ($row['clave'] == $clave) {
        $new_fila = strtr($new_fila, array('>' => ' selected>'));
      }
      $filas .= $new_fila;
    }
    $body = str_replace($fila, $filas, $body);

    $this->onload_fcn = 'on_load()';
    return $body;
  }
}

?>
