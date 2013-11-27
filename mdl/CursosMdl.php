<?php

require_once('mdl/BaseMdl.php');
class CursosMdl extends BaseMdl {
  public function agregar($ciclo, $clave,$nrc,$seccion, $dia, $hora, $duracion)
  {
    $query =
      "INSERT INTO curso (nrc, ciclo, clave_materia, seccion)
       VALUES (
         '$nrc',
         '$ciclo',
         '$clave',
         '$seccion',
       )";
    $r = $this->driver->query($query);
    if ($r === FALSE) {
      echo 'Error: ' . $this->driver->error;
      return FALSE;
    }

    if(strlen($dia)!=0)
    {
      $dia=trim($dia,",");
      $hora=trim($hora,",");
      $duracion=trim($duracion,",");
      $dia=explode(",", $dia);
      $hora=explode(",", $hora);
      $duracion=explode(",", $duracion);
      for($i=0;$i<sizeof($dia);$i++)
      {
        $query=
        "INSERT INTO detalle_curso VALUES(
        '$nrc',
        '".$dia[$i]."',
        '".$duracion[$i]."',
        '".$hora[$i]."')";
        $r = $this->driver->query($query);
      }
    }
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
