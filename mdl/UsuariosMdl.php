<?php

require_once('mdl/BaseMdl.php');
class UsuariosMdl extends BaseMdl {
  public function agregar($codigo, $nombres, $apellidos, $password, $tipo,
                          $carrera, $email, $activo, $campoExtra, $tipoCampo)
  {
    $query =
      "INSERT INTO usuario (codigo, nombres, apellidos, password, tipo_usuario,
                            carrera, email, activo)
       VALUES (
         '$codigo',
         '$nombres',
         '$apellidos',
         '$password',
         '$tipo',
         '$carrera',
         '$email',
         '$activo'
       )";
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
  }
}

?>
