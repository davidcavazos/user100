<?php

require_once('mdl/BaseMdl.php');
class CursosMdl extends BaseMdl {
  public function alta($nrc, $ciclo, $nombre, $seccion, $academia, $horarios)
  {
    $query =
      "INSERT INTO curso (nrc, ciclo, nombre_materia, seccion, academia,
                          carga_horaria)
       VALUES (
         '$nrc',
         '$ciclo',
         '$nombre',
         '$seccion',
         '$academia',
         '$horarios'
       )";
    $r = $this->driver->query($query);
    if ($r === FALSE) {
      echo 'Error: ' . $this->driver->error;
      return FALSE;
    }
    return $this->driver->insert_id;
  }
}

?>
