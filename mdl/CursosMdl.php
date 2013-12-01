<?php

require_once('mdl/BaseMdl.php');
class CursosMdl extends BaseMdl {
  public function agregar($ciclonrc,$ciclo, $clave,$nrc,
  $seccion, $dia, $hora, $duracion)
  {
    $query =
      "INSERT INTO curso (ciclonrc,nrc, ciclo, clave_materia, seccion)
       VALUES (
         '$ciclonrc',
         '$nrc',
         '$ciclo',
         '$clave',
         '$seccion'
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
        '$ciclonrc',
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

  public function modificar($nrc, $ciclonrc, $ciclo, $clave, $seccion,
                            $dia, $hora, $duracion)
  {
    $query =
      "UPDATE curso SET
         nrc='$nrc',
         ciclo='$ciclo',
         clave_materia='$clave',
         seccion='$seccion'
       WHERE ciclonrc='$ciclonrc'";
    $r = $this->driver->query($query);
    if ($r === FALSE) {
      echo 'Error: ' . $this->driver->error;
      return FALSE;
    }
    $query="DELETE FROM detalle_curso WHERE ciclonrc='".$ciclonrc."'";
    $r = $this->driver->query($query);
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
        '".$ciclonrc."',
        '".$dia[$i]."',
        '".$duracion[$i]."',
        '".$hora[$i]."')";
        $r = $this->driver->query($query);
      }
    }
    return $this->driver->insert_id;
  }
}

?>
