<?php

require_once('mdl/BaseMdl.php');
class AsistenciasMdl extends BaseMdl {
  public function get_dias_lista($ciclo, $nrc, $month) {
    $year = substr($ciclo,0,4);
    $dias = $this->days_in_month($month, $year);

    $q = $this->datos("SELECT dia FROM detalle_curso WHERE ciclonrc='$ciclo$nrc'");
    $semana = array();
    foreach ($q as $r) {
      switch ($r['dia']) {
        case 'Domingo':
          $semana[] = 0;
          break;
        case 'Lunes':
          $semana[] = 1;
          break;
        case 'Martes':
          $semana[] = 2;
          break;
        case 'Miercoles':
          $semana[] = 3;
          break;
        case 'Jueves':
          $semana[] = 4;
          break;
        case 'Viernes':
          $semana[] = 5;
          break;
        case 'Sabado':
          $semana[] = 6;
          break;
      }
    }

    $lista = array();
    for ($i = 1; $i <= $dias; $i++) {
      $dia_sem = date('w', strtotime("$month/$i/$year"));
      if (in_array($dia_sem, $semana)) {
        $lista[] = $i;
      }
    }
    return $lista;
  }

  public function get_asistencias($ciclo, $nrc, $month, $codigo) {
    $year = substr($ciclo,0,4);
    $tipo_ciclo = strtolower(substr($ciclo, -1));
    $idx = 1;
    if ($tipo_ciclo == 'a') {
      $idx = $month - 1;
    } elseif ($tipo_ciclo == 'b') {
      $idx = $month - 7;
    }
    $q = $this->datos("SELECT mes$idx FROM grupo WHERE ciclonrc='$ciclo$nrc' AND codigo='$codigo'");
    if (count($q) > 0) {
      return $q[0]["mes$idx"];
    }
    return -1;
  }

  public function guardar_asistencias($ciclo, $nrc, $month, $codigo, $mes) {
    $year = substr($ciclo,0,4);
    $tipo_ciclo = strtolower(substr($ciclo, -1));
    $idx = 1;
    if ($tipo_ciclo == 'a') {
      $idx = $month - 1;
    } elseif ($tipo_ciclo == 'b') {
      $idx = $month - 7;
    }
    $this->driver->query("UPDATE grupo SET mes$idx='$mes' WHERE ciclonrc='$ciclo$nrc' AND codigo='$codigo'");
  }

  private function days_in_month($month, $year) {
    if(checkdate($month, 31, $year)) return 31;
    if(checkdate($month, 30, $year)) return 30;
    if(checkdate($month, 29, $year)) return 29;
    if(checkdate($month, 28, $year)) return 28;
    return 0; // error
  }
}

?>
