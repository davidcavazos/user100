<?php

require_once('ctl/BaseCtl.php');
class AsistenciasCtl extends BaseCtl {
  public function ejecutar() {
    require_once('mdl/AsistenciasMdl.php');
    $mdl = new AsistenciasMdl();
    if (isset($_POST['guardar'])) {
      $ciclo = $_POST['ciclo'];
      $nrc = $_POST['nrc'];
      $month = $_POST['month'];
      $codigos = $_POST['codigos'];
      $asistencias = $_POST['asistencias'];
      for ($i = 0; $i < count($codigos); $i++) {
        $mes = $this->set_mes($asistencias[$i]);
        $mdl->guardar_asistencias($ciclo, $nrc, $month, $codigos[$i], $mes);
      }
    } else {
      $this->mostrar();
    }
  }

  public function generarBody() {
    require_once('mdl/AsistenciasMdl.php');
    $mdl = new AsistenciasMdl();

    $body = file_get_contents($this->vstFile);

    // Ciclo
    $inicio_fila = strrpos($body, '<option value="{CICLO}">');
    $final_fila = $inicio_fila + 40;
    $fila = substr($body, $inicio_fila, $final_fila - $inicio_fila);

    $datos = $mdl->get_ciclos();
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
    $inicio_fila = strrpos($body, '<option value="{CURSO}">');
    $final_fila = $inicio_fila + 40;
    $fila = substr($body, $inicio_fila, $final_fila - $inicio_fila);

    $datos = $mdl->get_cursos($ciclo);
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
        '{CURSO}' => $row['nrc'].' - '.$row['clave'].' - '.$row['materia'].' ('.$row['seccion'].')',
      );
      $new_fila = strtr($new_fila, $dict);
      if ($row['nrc'] == $nrc) {
        $new_fila = strtr($new_fila, array('>' => ' selected>'));
      }
      $filas .= $new_fila;
    }
    $body = str_replace($fila, $filas, $body);

    // Meses
    $tipo_ciclo = strtolower(substr($ciclo, -1));
    if (isset($_GET['mes'])) {
      $month = $_GET['mes'];
    } else {
      $month = date('m');
    }

    $inicio_fila = strrpos($body, '<option value="{MES}">');
    $final_fila = $inicio_fila + 40;
    $fila = substr($body, $inicio_fila, $final_fila - $inicio_fila);
    $filas = '';
    if ($tipo_ciclo == 'a') {
      $f = $month <= 2 ? str_replace('>',' selected>',$fila) : $fila;
      $filas .= str_replace('{MES}','2', str_replace('{MES_NOM}','Febrero',$f));
      $f = $month == 3 ? str_replace('>',' selected>',$fila) : $fila;
      $filas .= str_replace('{MES}','3', str_replace('{MES_NOM}','Marzo',$f));
      $f = $month == 4 ? str_replace('>',' selected>',$fila) : $fila;
      $filas .= str_replace('{MES}','4', str_replace('{MES_NOM}','Abril',$f));
      $f = $month == 5 ? str_replace('>',' selected>',$fila) : $fila;
      $filas .= str_replace('{MES}','5', str_replace('{MES_NOM}','Mayo',$f));
      $f = $month >= 6 ? str_replace('>',' selected>',$fila) : $fila;
      $filas .= str_replace('{MES}','6', str_replace('{MES_NOM}','Junio',$f));
    } elseif ($tipo_ciclo == 'b') {
      $f = $month <= 8 ? str_replace('>',' selected>',$fila) : $fila;
      $filas .= str_replace('{MES}','8', str_replace('{MES_NOM}','Agosto',$f));
      $f = $month == 9 ? str_replace('>',' selected>',$fila) : $fila;
      $filas .= str_replace('{MES}','9', str_replace('{MES_NOM}','Septiembre',$f));
      $f = $month == 10 ? str_replace('>',' selected>',$fila) : $fila;
      $filas .= str_replace('{MES}','10',str_replace('{MES_NOM}','Octubre',$f));
      $f = $month == 11 ? str_replace('>',' selected>',$fila) : $fila;
      $filas .= str_replace('{MES}','11',str_replace('{MES_NOM}','Noviembre',$f));
      $f = $month >= 12 ? str_replace('>',' selected>',$fila) : $fila;
      $filas .= str_replace('{MES}','12',str_replace('{MES_NOM}','Diciembre',$f));
    }
    $body = str_replace($fila, $filas, $body);

    // Dias
    $dias = $mdl->get_dias_lista($ciclo, $nrc, $month);

    $inicio_fila = strrpos($body, '<th>{DIA}</th>');
    $final_fila = $inicio_fila + 14;
    $col = substr($body, $inicio_fila, $final_fila - $inicio_fila);
    $cols = '';
    foreach ($dias as $dia) {
      $cols .= str_replace('{DIA}',$dia,$col);
    }
    $body = str_replace($col, $cols, $body);

    // Alumnos
    $inicio_fila = strrpos($body, '<tr>');
    $final_fila = strrpos($body, '</tr>') + 5;
    $fila = substr($body, $inicio_fila, $final_fila - $inicio_fila);

    $datos = $mdl->get_alumnos_en_curso($ciclo, $nrc);
    $filas = '';
    $num = 1;
    foreach ($datos as $row) {
      if ($row['activo'] == 0) {
        continue;
      }
      $new_fila = $fila;

      $mes = $mdl->get_asistencias($ciclo, $nrc, $month, $row['codigo']);
      $start = strpos($fila, '<!--DATA{-->') + 12;
      $end = strpos($fila, '<!--}DATA-->');
      $col = substr($fila, $start, $end - $start);
      $cols = '';
      $n = 1;
      $total = 0;
      foreach ($dias as $dia) {
        $sel = '';
        if ($this->get_dia($mes, $dia)) {
          $sel = ' checked';
          $total++;
        }
        $cols .= str_replace('{Y}',$n,str_replace('{SEL}',$sel,$col));
        $n += 1;
      }
      $new_fila = str_replace($col, $cols, $new_fila);

      $dict = array(
        '{X}' => $num,
        '{CODIGO}' => $row['codigo'],
        '{NOMBRE}' => $row['apellidos'] . ', ' . $row['nombres'],
        '{TOTAL}' => number_format(100 * $total / count($dias)).'%'
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

  private function get_dia($mes, $dia) {
    /*
    if ($dia == 3) {
      echo "$mes: ";
      for ($i = 0; $i < 31; $i++) {
        $mask = 1 << $i;
        $val = $mes & $mask;
        $val = $val >> $i;
        echo $val;
      }
      echo ' | ';
    } */
    $mask = 1 << $dia;
    $val = $mes & $mask;
    return $val >> $dia;
  }

  private function set_mes($asistencias) {
    $mes = -1;
    for ($i = 0; $i < count($asistencias); $i++) {
      if ($asistencias[$i] == '') {
        continue;
      }
      if ($asistencias[$i] == 'false') {
        $mask = 1 << $i;
        $mask = ~$mask;
        $mes &= $mask;
      }
    }
    return $mes;
  }
}

?>
