<?php

require_once('mdl/BaseMdl.php');
class CursosMdl extends BaseMdl {
  public function agregar($nrc, $ciclo, $nombre, $seccion, $academia, $dias,
                          $horas_por_dia, $horarios)
  {
    $query =
      "INSERT INTO curso (nrc, ciclo, nombre_materia, seccion, academia)
       VALUES (
         '$nrc',
         '$ciclo',
         '$nombre',
         '$seccion',
         '$academia'
       )";
    $r = $this->driver->query($query);
    if ($r === FALSE) {
      echo 'Error: ' . $this->driver->error;
      return FALSE;
    }
    return $this->driver->insert_id;
  }

  public function modificar($nrc, $new_nrc, $ciclo, $materia, $seccion,
                            $academia, $dias, $horas_por_dia, $horarios)
  {
    $query =
      "UPDATE curso SET
         nrc='$new_nrc',
         ciclo='$ciclo',
         nombre='$nombre',
         seccion='$seccion',
         academia='$academia'
       WHERE nrc='$nrc'";
    $r = $this->driver->query($query);
    if ($r === FALSE) {
      echo 'Error: ' . $this->driver->error;
      return FALSE;
    }
    return $this->driver->insert_id;
  }
}

?>
