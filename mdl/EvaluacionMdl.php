<?php

require_once('mdl/BaseMdl.php');
class EvaluacionMdl extends BaseMdl {
  public function agregar($codigo, $ciclonrc)
  {
    $query =
      "INSERT INTO grupo
       VALUES (
         '$ciclonrc',
         '$codigo',
         1,
         1,
         1,
         1,
         1
       )";
    $r = $this->driver->query($query);
    if ($r === FALSE) {
      echo 'Error: ' . $this->driver->error;
      return FALSE;
    }
    return $this->driver->insert_id;
  }

  public function insertarRubros($rubros, $subrubros, $rubrosp, $subrubrosp)
  {
    $rubros=trim($rubros,"|");
    $subrubros=trim($subrubros,"|");
    $rubrosp=trim($rubrosp,"|");
    $subrubrosp=trim($subrubrosp,"|");
    $rubros=explode("|", $rubros);
    $subrubros=explode("|", $subrubros);
    $rubrosp=explode("|", $rubrosp);
    $subrubrosp=explode("|", $subrubrosp);
    for($i=0;$i<sizeof($rubros);$i++)
    {   
      $query=
      "INSERT INTO rubros VALUES(
      '$ciclo',
      '".$dia_festivo[$i]."',
      '".$descripcion[$i]."')";
      $r = $this->driver->query($query);
    }   
       
    if ($r === FALSE) {
      echo 'Error: ' . $this->driver->error;
      return FALSE;
    }
 
  }

  public function insertarDesdeArchivo($codigo,$ciclo, $nrc)
  {
    foreach($codigo as $c)
    {
      $q=$this->datos("SELECT codigo FROM usuario WHERE codigo = '$c' AND tipo_usuario=2");
      if(count($q)==0)
      {
        continue;
      }
      if(!strcmp($c,$q[0]['codigo']))
      {
        $q=$this->datos("SELECT codigo FROM grupo WHERE codigo = '$c' AND ciclonrc='".$ciclo.$nrc."'");
        if(count($q)!=0)
        {
          continue;
        }
        $query="INSERT INTO grupo VALUES('".$ciclo.$nrc."',
        '$c',
        1,
        1,
        1,
        1,
        1)";
        $r = $this->driver->query($query);
        if ($r === FALSE)
        {
          echo 'Error: ' . $this->driver->error;
        }

      }
    }
  }

  public function get_alumnos($ciclonrc) {
    return $this->datos("SELECT * FROM usuario WHERE tipo_usuario=2 AND codigo NOT IN (SELECT codigo FROM grupo WHERE ciclonrc='$ciclonrc') AND tipo_usuario>0 ORDER BY apellidos");
  }

  /*public function modificar($codigo, $new_codigo, $nombres, $apellidos,
                            $carrera, $email, $campoExtra, $tipoCampo)
  {
    $query =
      "UPDATE usuario SET
         codigo='$new_codigo',
         nombres='$nombres',
         apellidos='$apellidos',
         carrera='$carrera',
         email='$email'
       WHERE codigo='$codigo'";
    $r = $this->driver->query($query);
    if ($r === FALSE) {
      echo 'Error: ' . $this->driver->error;
      return FALSE;
    }
    if(strlen($campoExtra)!=0)
    {
      $campoExtra=trim($campoExtra,",");
      $tipoCampo=trim($tipoCampo,",");
      $campoExtra=explode(",",$campoExtra);
      $tipoCampo=explode(",", $tipoCampo);
      for($i=0;$i<sizeof($tipoCampo);$i++)
      {
        $query=
        "INSERT INTO detalle_usuario VALUES(
        '$codigo',
        '".$tipoCampo[$i]."',
        '".$campoExtra[$i]."')";
        $r = $this->driver->query($query);
        if ($r === FALSE)
        {
          echo 'Error: ' . $this->driver->error;
          return FALSE;
        }
      }
    }
    echo 'modificando';
    return $this->driver->insert_id;
  }

  public function desactivar($codigo) {
    $query =
      "UPDATE usuario SET
         activo='0'
       WHERE codigo='$codigo'";
    $r = $this->driver->query($query);
    if ($r === FALSE) {
      echo 'Error: ' . $this->driver->error;
      return FALSE;
    }
    return $this->driver->insert_id;
  }*/
}

?>
