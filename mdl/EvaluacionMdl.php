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
