<?php

require_once('mdl/BaseMdl.php');
class CiclosMdl extends BaseMdl {
  public function agregar($ciclo, $fecha_inicio, $fecha_fin, $dia_festivo, $descripcion) {
    $query =
      "INSERT INTO ciclo_escolar (ciclo, fecha_inicio, fecha_fin)
       VALUES (
         '$ciclo',
         '$fecha_inicio',
         '$fecha_fin'
       )";
    $r = $this->driver->query($query);
	if(strlen($dia_festivo)!=0)
	{
		$dia_festivo=trim($dia_festivo,",");
		$descripcion=trim($descripcion,",");
		$dia_festivo=explode(",", $dia_festivo);
		$descripcion=explode(",", $descripcion);
		for($i=0;$i<sizeof($dia_festivo);$i++){
			$query=
			"INSERT INTO detalle_ciclo_escolar VALUES(
			'$ciclo',
			,'$dia_festivo[0]',
			'$descripcion[0]')";
			$r = $this->driver->query($query);
		}
	}
    if ($r === FALSE) {
      echo 'Error: ' . $this->driver->error;
      return FALSE;
    }

    return $this->driver->insert_id;
  }

  public function modificar($ciclo, $new_ciclo, $fecha_inicio, $fecha_fin) {
    $query =
      "UPDATE ciclo_escolar SET
         ciclo='$new_ciclo',
         fecha_inicio='$fecha_inicio',
         fecha_fin='$fecha_fin'
       WHERE ciclo='$ciclo'";
    $r = $this->driver->query($query);
    if ($r === FALSE) {
      echo 'Error: ' . $this->driver->error;
      return FALSE;
    }
    return $this->driver->insert_id;
  }
}

?>
