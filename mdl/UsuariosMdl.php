<?php

require_once('mdl/BaseMdl.php');
class UsuariosMdl extends BaseMdl {
  public function alta($codigo, $nombres, $apellidos, $password, $tipo,
                       $carrera, $email, $activo)
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
    return $this->driver->insert_id;
  }
}

?>
