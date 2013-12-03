<?php

require_once('mdl/BaseMdl.php');
class CursosMdl extends BaseMdl {
  public function agregar($ciclonrc, $codigo_profesor, $ciclo, $clave,$nrc, $seccion, $dia, $hora, $duracion)
  {
    $query =
      "INSERT INTO curso (ciclonrc, codigo_profesor, nrc, ciclo, clave_materia, seccion, mes1, mes2, mes3, mes4, mes5)
       VALUES (
         '$ciclonrc',
         '$codigo_profesor',
         '$nrc',
         '$ciclo',
         '$clave',
         '$seccion',
         '-1',
         '-1',
         '-1',
         '-1',
         '-1'
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

  public function get_info_curso($ciclo, $nrc) {
    return $this->datos("SELECT * FROM curso INNER JOIN materia WHERE clave_materia=clave AND ciclonrc='$ciclo$nrc'")[0];
  }

  public function get_info_detalle_curso($ciclo, $nrc) {
    return $this->datos("SELECT * FROM detalle_curso WHERE ciclonrc='$ciclo$nrc'");
  }

  public function get_info_materia($clave) {
    return $this->datos("SELECT * FROM materia WHERE clave='$clave'")[0];
  }

  public function get_claves_materia() {
    return $this->datos("SELECT clave FROM materia");
  }
}

?>
