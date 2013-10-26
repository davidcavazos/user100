<?php

require_once('mdl/BaseMdl.php');
class CiclosMdl extends BaseMdl {
  public function alta($ciclo, $fecha_inicio, $fecha_fin) {
    $query =
      "INSERT INTO ciclo_escolar (ciclo, fecha_inicio, fecha_fin)
       VALUES (
         '$ciclo',
         '$fecha_inicio',
         '$fecha_fin'
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
